<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function home(): View
    {
        $featuredProperties = Property::with(['images', 'owner'])
            ->latest()
            ->take(6)
            ->get();

        return view('home', [
            'featuredProperties' => $featuredProperties,
        ]);
    }

    public function index(Request $request): View
    {
        $properties = $request->user()->properties()->with('images')->latest()->paginate(10);

        return view('seller.dashboard', [
            'properties' => $properties,
            'stats' => [
                'total' => $request->user()->properties()->count(),
                'for_sale' => $request->user()->properties()->where('type', Property::TYPE_SALE)->count(),
                'for_rent' => $request->user()->properties()->where('type', Property::TYPE_RENT)->count(),
                'revenue' => \App\Models\Deal::where('seller_id', $request->user()->id)->where('status', \App\Models\Deal::STATUS_COMPLETED)->sum('amount'),
            ]
        ]);
    }

    public function catalog(Request $request): View
    {
        $selectedType = $request->string('type')->toString();
        $selectedCategory = $request->string('category')->toString();
        $search = $request->string('search')->toString();

        $propertiesQuery = Property::with(['images', 'owner'])->where('status', Property::STATUS_APPROVED)->latest();

        if ($search !== '') {
            $propertiesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if (in_array($selectedType, Property::TYPES, true)) {
            $propertiesQuery->where('type', $selectedType);
        } else {
            $selectedType = '';
        }

        if (in_array($selectedCategory, Property::CATEGORIES, true)) {
            $propertiesQuery->where('category', $selectedCategory);
        } else {
            $selectedCategory = '';
        }

        $properties = $propertiesQuery->paginate(9)->withQueryString();

        return view('property-listing', [
            'properties' => $properties,
            'selectedType' => $selectedType,
            'selectedCategory' => $selectedCategory,
            'categories' => Property::CATEGORIES,
            'types' => Property::TYPES,
        ]);
    }

    public function show(Property $property): View
    {
        $property->load(['images', 'owner']);

        $relatedProperties = Property::with('images')
            ->where('id', '!=', $property->id)
            ->where('type', $property->type)
            ->latest()
            ->take(3)
            ->get();

        return view('property-details', [
            'property' => $property,
            'relatedProperties' => $relatedProperties,
        ]);
    }

    public function create(): View
    {
        return view('post-property', [
            'property' => new Property(),
            'types' => Property::TYPES,
            'categories' => Property::CATEGORIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->validationRules(true));

        $data = $this->extractPropertyData($validated);
        $data['status'] = Property::STATUS_PENDING;

        $property = $request->user()->properties()->create($data);

        $this->storeImages($property, $request->file('images', []));

        return redirect()
            ->route('property.details', $property)
            ->with('status', 'Property posted successfully.');
    }

    public function edit(Property $property): View
    {
        $this->authorizeManagement($property, request()->user());

        $property->load('images');

        return view('properties.edit', [
            'property' => $property,
            'types' => Property::TYPES,
            'categories' => Property::CATEGORIES,
        ]);
    }

    public function update(Request $request, Property $property): RedirectResponse
    {
        $this->authorizeManagement($property, $request->user());

        $validated = $request->validate($this->validationRules(false));

        $property->update($this->extractPropertyData($validated));

        $removeImages = collect($validated['remove_images'] ?? [])
            ->map(static fn (mixed $id): int => (int) $id)
            ->all();

        if ($removeImages !== []) {
            $imagesToDelete = $property->images()->whereIn('id', $removeImages)->get();

            foreach ($imagesToDelete as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        $newImages = $request->file('images', []);
        if ($newImages !== []) {
            $this->storeImages($property, $newImages, $property->images()->doesntExist());
        }

        $this->ensurePrimaryImage($property);

        return redirect()
            ->route('property.details', $property)
            ->with('status', 'Property updated successfully.');
    }

    public function destroy(Request $request, Property $property): RedirectResponse
    {
        $this->authorizeManagement($property, $request->user());

        $property->load('images');

        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $property->delete();

        return redirect()
            ->route('properties.listing')
            ->with('status', 'Property deleted successfully.');
    }



    /**
     * @return array<string, mixed>
     */
    private function validationRules(bool $creating): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'price' => ['required', 'numeric', 'min:0'],
            'type' => ['required', Rule::in(Property::TYPES)],
            'category' => ['required', Rule::in(Property::CATEGORIES)],
            'location' => ['required', 'string', 'max:500'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'sqft' => ['required', 'integer', 'min:0'],
            'images' => [$creating ? 'required' : 'nullable', 'array', 'max:8'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:102400'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer', Rule::exists('property_images', 'id')],
        ];
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function extractPropertyData(array $validated): array
    {
        return [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'type' => $validated['type'],
            'category' => $validated['category'],
            'location' => $validated['location'],
            'bedrooms' => $validated['bedrooms'],
            'bathrooms' => $validated['bathrooms'],
            'sqft' => $validated['sqft'],
        ];
    }

    /**
     * @param  array<int, \Illuminate\Http\UploadedFile>  $images
     */
    private function storeImages(Property $property, array $images, bool $assignPrimaryFromFirst = true): void
    {
        foreach ($images as $index => $image) {
            $path = $image->store('property-images', 'public');

            $property->images()->create([
                'path' => $path,
                'is_primary' => $assignPrimaryFromFirst && $index === 0,
            ]);

            if ($assignPrimaryFromFirst && $index === 0) {
                $property->update(['image' => $path]);
            }
        }
    }

    private function ensurePrimaryImage(Property $property): void
    {
        $property->refresh()->load('images');

        if ($property->images->isEmpty()) {
            return;
        }

        $hasPrimary = $property->images->contains(static fn (PropertyImage $image): bool => $image->is_primary);

        if (! $hasPrimary) {
            $property->images->first()?->update(['is_primary' => true]);
        }
    }

    private function authorizeManagement(Property $property, User $user): void
    {
        if ($user->isAdmin() || $user->isStaff()) {
            return;
        }

        if ($user->isSeller() && $property->user_id === $user->id) {
            return;
        }

        abort(403);
    }
}
