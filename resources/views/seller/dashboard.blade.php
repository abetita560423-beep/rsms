<x-app-layout>
    <x-slot name="header">
        {{ __('My Properties') }}
    </x-slot>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-houses" viewBox="0 0 16 16"><path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5A1.5 1.5 0 0 0 3.5 14h.11c.11.207.265.383.45.517A2.5 2.5 0 0 1 3.5 15h-.11a.5.5 0 0 1-.41-.832L3 14.168V12.5A2.5 2.5 0 0 1 5.5 10h.707L5.793 1ZM14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h9Zm-9-1A1.5 1.5 0 0 0 4 3.5v9A1.5 1.5 0 0 0 5.5 14h9a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-9Z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['total'] }}</h3>
                        <p class="text-secondary small mb-0 fw-bold">TOTAL LISTINGS</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16"><path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/><path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['for_sale'] }}</h3>
                        <p class="text-secondary small mb-0 fw-bold">FOR SALE</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16"><path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853.854a.5.5 0 0 0 .708 0l.646-.647.646.647a.5.5 0 0 0 .708 0l.646-.647.646.647a.5.5 0 0 0 .708 0l1.5-1.5a.5.5 0 0 0 0-.708l-1.5-1.5a.5.5 0 0 0-.708 0l-.646.647-.646-.647a.5.5 0 0 0-.708 0l-.646.647-.646-.647a.5.5 0 0 0-.708 0l-.646.647h-.793a.5.5 0 0 1-.354-.146L7.163 6.5a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['for_rent'] }}</h3>
                        <p class="text-secondary small mb-0 fw-bold">FOR RENT</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Property</th>
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
                            <td class="px-4 py-3 fw-bold text-dark">
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
                                    <a href="{{ route('properties.edit', $property) }}" class="btn btn-sm btn-outline-secondary fw-bold px-3">Edit</a>
                                    <form action="{{ route('properties.destroy', $property) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none fw-bold" onclick="return confirm('Delete this listing?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                No properties found.
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
</x-app-layout>
