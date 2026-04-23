@php
    $isEditing = $property->exists;
@endphp

<form method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
    @csrf
    @if ($isEditing)
        @method('PUT')
    @endif

    <div class="row g-4 mb-4">
        <div class="col-12">
            <label for="title" class="form-label fw-semibold">Property Title</label>
            <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $property->title) }}" placeholder="e.g. Beautiful Family Home in Suburbs" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="type" class="form-label fw-semibold">Listing Type</label>
            <select id="type" name="type" class="form-select @error('type') is-invalid @enderror" required>
                <option value="" disabled @selected(old('type', $property->type) === null)>Select type</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" @selected(old('type', $property->type) === $type)>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="category" class="form-label fw-semibold">Category</label>
            <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
                <option value="" disabled @selected(old('category', $property->category) === null)>Select category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(old('category', $property->category) === $category)>
                        {{ ucfirst($category) }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="price" class="form-label fw-semibold">Price ($)</label>
            <input type="number" min="0" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $property->price) }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="location" class="form-label fw-semibold">Location</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $property->location) }}" placeholder="City, Country" required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="bedrooms" class="form-label fw-semibold">Bedrooms</label>
            <input type="number" min="0" class="form-control @error('bedrooms') is-invalid @enderror" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" required>
            @error('bedrooms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="bathrooms" class="form-label fw-semibold">Bathrooms</label>
            <input type="number" min="0" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" required>
            @error('bathrooms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="sqft" class="form-label fw-semibold">Square Feet</label>
            <input type="number" min="0" class="form-control @error('sqft') is-invalid @enderror" id="sqft" name="sqft" value="{{ old('sqft', $property->sqft) }}" required>
            @error('sqft')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="description" class="form-label fw-semibold">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $property->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Images Section -->
    <div class="card bg-light border-0 rounded-4 mb-4">
        <div class="card-body p-4">
            <label for="images" class="form-label fw-bold text-dark mb-1">
                {{ $isEditing ? 'Add More Images (optional)' : 'Property Images' }}
            </label>
            <p class="text-secondary small mb-3">Upload up to 8 images total (JPG, PNG, WEBP). Max 5MB per image.</p>
            <input class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" type="file" id="images" name="images[]" multiple accept="image/png,image/jpeg,image/webp" {{ $isEditing ? '' : 'required' }}>
            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('images.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    @if ($isEditing && $property->relationLoaded('images') && $property->images->isNotEmpty())
        <div class="mb-4">
            <label class="form-label fw-bold text-dark mb-1">Current Images</label>
            <p class="text-secondary small mb-3">Select images to remove when saving.</p>
            <div class="row g-3">
                @foreach ($property->images as $image)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Existing property image" class="card-img-top object-fit-cover" style="height: 120px;">
                            <div class="card-footer bg-white border-top-0 p-2 d-flex justify-content-between align-items-center">
                                <div class="form-check m-0">
                                    <input class="form-check-input text-danger" type="checkbox" name="remove_images[]" value="{{ $image->id }}" id="remove_img_{{ $image->id }}">
                                    <label class="form-check-label text-danger small fw-medium" for="remove_img_{{ $image->id }}">
                                        Remove
                                    </label>
                                </div>
                                @if ($image->is_primary)
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1" style="font-size: 0.65rem;">Primary</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('remove_images')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>
    @endif

    <div class="d-flex align-items-center gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-primary fw-medium px-4 py-2">{{ $submitLabel }}</button>
        <a href="{{ $cancelRoute }}" class="btn btn-outline-secondary fw-medium px-4 py-2">Cancel</a>
    </div>
</form>
