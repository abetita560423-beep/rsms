<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModerationController extends Controller
{
    public function allProperties(): View
    {
        $properties = Property::with('owner')
            ->latest()
            ->paginate(15);

        return view('admin.properties.index', [
            'properties' => $properties,
        ]);
    }

    public function pendingProperties(): View
    {
        $pendingProperties = Property::with('owner')
            ->where('status', Property::STATUS_PENDING)
            ->latest()
            ->paginate(15);

        return view('admin.properties.pending', [
            'properties' => $pendingProperties,
        ]);
    }

    public function approve(Property $property): RedirectResponse
    {
        $property->update(['status' => Property::STATUS_APPROVED]);

        $property->owner->notifications()->create([
            'type' => Notification::TYPE_PROPERTY_APPROVED,
            'message' => "Your property '{$property->title}' has been approved.",
        ]);

        return back()->with('status', 'Property approved successfully.');
    }

    public function reject(Property $property): RedirectResponse
    {
        $property->update(['status' => Property::STATUS_REJECTED]);

        $property->owner->notifications()->create([
            'type' => Notification::TYPE_PROPERTY_REJECTED,
            'message' => "Your property '{$property->title}' has been rejected.",
        ]);

        return back()->with('status', 'Property rejected successfully.');
    }

    public function destroy(Property $property): RedirectResponse
    {
        $property->delete();

        return back()->with('status', 'Property deleted successfully.');
    }
}
