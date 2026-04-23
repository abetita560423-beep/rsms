@extends('layouts.public')

@section('title', 'Explore Properties | SummitHub')

@section('content')
    <div class="bg-white border-bottom py-5 mb-5">
        <div class="container">
            <h1 class="fw-bolder tracking-tighter mb-2">Explore Properties</h1>
            <p class="text-secondary mb-0">Discover your next residential masterpiece from our curated collection.</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-4">Search & Filters</h5>
                    <form method="GET" action="{{ route('properties.listing') }}">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Keyword</label>
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Title or location...">
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Transaction Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" @selected($selectedType === $type)>{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Category</label>
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}" @selected($selectedCategory === $category)>{{ ucfirst($category) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="{{ route('properties.listing') }}" class="btn btn-light fw-bold text-muted">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Listings Grid -->
            <div class="col-lg-9">
                @if ($properties->isEmpty())
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                        <div class="py-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="text-light mb-4" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M4 4h8v8H4V4z"/></svg>
                            <h3 class="fw-bold">No Properties Found</h3>
                            <p class="text-secondary">Try adjusting your filters or search keywords.</p>
                        </div>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($properties as $property)
                            @php
                                $imageUrl = $property->image 
                                    ? asset('storage/' . $property->image) 
                                    : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1200&auto=format&fit=crop';
                                $user = auth()->user();
                                $canManage = $user && ($user->isAdmin() || $user->isStaff() || ($user->isSeller() && $property->user_id === $user->id));
                            @endphp
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift bg-white">
                                    <div class="position-relative" style="height: 220px;">
                                        <img src="{{ $imageUrl }}" class="w-100 h-100 object-fit-cover" alt="{{ $property->title }}">
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span class="badge bg-white text-primary shadow-sm">{{ strtoupper($property->type) }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="text-primary" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                                            <span class="small text-muted fw-bold text-uppercase">{{ $property->location }}</span>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-3 h4">{{ $property->title }}</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-3 small fw-bold text-secondary">
                                                <span>{{ $property->bedrooms }} BD</span>
                                                <span>{{ $property->bathrooms }} BA</span>
                                            </div>
                                            <div class="text-primary fw-bolder fs-4">₱{{ number_format($property->price, 0) }}</div>
                                        </div>
                                        <hr class="my-4 opacity-10">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('property.details', $property) }}" class="btn btn-light flex-grow-1 fw-bold text-primary">Details</a>
                                            @if ($canManage)
                                                <a href="{{ route('properties.edit', $property) }}" class="btn btn-outline-secondary px-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $properties->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
