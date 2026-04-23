<x-app-layout>
    <x-slot name="header">
        {{ __('All Properties Management') }}
    </x-slot>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Global Catalog</h4>
                <p class="text-secondary small mb-0">Monitor, filter, and manage every property listing on the platform.</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Property</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Seller</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Price</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $property)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        @php
                                            $imageUrl = $property->image 
                                                ? asset('storage/' . $property->image) 
                                                : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=100&auto=format&fit=crop';
                                        @endphp
                                        <img src="{{ $imageUrl }}" class="rounded-3 shadow-sm" width="56" height="56" style="object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark">{{ $property->title }}</div>
                                            <small class="text-muted">{{ $property->location }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="fw-bold text-dark small">{{ $property->owner->name ?? 'Unknown' }}</div>
                                    <small class="text-muted">{{ $property->owner->email ?? '' }}</small>
                                </td>
                                <td class="px-4 py-3 fw-bold text-primary">
                                    ₱{{ number_format($property->price, 0) }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $badgeClass = match($property->status) {
                                            'approved' => 'bg-success',
                                            'rejected' => 'bg-danger',
                                            default => 'bg-warning text-dark',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} text-uppercase fw-bold" style="font-size: 0.7rem;">
                                        {{ $property->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('property.details', $property) }}" target="_blank" class="btn btn-sm btn-light fw-bold px-3 rounded-pill">View</a>
                                        <a href="{{ route('properties.edit', $property) }}" class="btn btn-sm btn-outline-secondary fw-bold px-3 rounded-pill">Edit</a>
                                        <form action="{{ route('admin.property.destroy', $property) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger fw-bold px-3 rounded-pill" onclick="return confirm('PERMANENTLY DELETE this listing?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    No properties found in the catalog.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($properties->hasPages())
                <div class="px-4 py-3 border-top">
                    {{ $properties->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
