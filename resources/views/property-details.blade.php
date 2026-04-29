@extends('layouts.public')

@section('title', $property->title . ' | Summit Estate')

@section('content')
    <style>
        .detail-header {
            padding: 60px 0;
            background: #ffffff;
            border-bottom: 1px solid #eef2f7;
        }
        .property-main-img {
            height: 600px;
            width: 100%;
            object-fit: cover;
            border-radius: 2rem;
        }
        .thumb-img {
            height: 100px;
            width: 100%;
            object-fit: cover;
            border-radius: 1rem;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .thumb-img:hover { opacity: 0.8; }
        .spec-card {
            background: #f8f9fc;
            border-radius: 1.25rem;
            padding: 1.5rem;
            text-align: center;
        }
        .inquiry-card {
            position: sticky;
            top: 100px;
            border-radius: 1.5rem;
        }
    </style>

    <div class="detail-header mb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('properties.listing') }}" class="text-decoration-none text-muted">Explore</a></li>
                            <li class="breadcrumb-item active fw-bold text-primary">{{ ucfirst($property->category) }}</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bolder tracking-tighter text-dark mb-2">{{ $property->title }}</h1>
                    <div class="d-flex align-items-center gap-2 text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="text-primary" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                        <span class="fw-medium">{{ $property->location }}</span>
                    </div>
                </div>
                <div class="text-md-end">
                    @php
                        $user = auth()->user();
                        $canManage = $user && ($user->isAdmin() || $user->isStaff() || ($user->isSeller() && $property->user_id === $user->id));
                    @endphp
                    @if($canManage)
                        <a href="{{ route('properties.edit', $property) }}" class="btn btn-outline-primary fw-bold px-4 rounded-pill mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>
                            Edit Property
                        </a>
                    @endif
                    <div class="d-block">
                        <span class="badge bg-primary text-white mb-2 px-3 py-2 fw-bold" style="letter-spacing: 1px;">{{ strtoupper($property->type) }}</span>
                        <h2 class="display-5 fw-bolder text-primary mb-0">₱{{ number_format($property->price, 0) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-5">
            <!-- Left Side -->
            <div class="col-lg-8">
                <!-- Main Image -->
                @php
                    $images = $property->images;
                    $primaryImageUrl = $property->image 
                        ? asset('storage/' . $property->image) 
                        : 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=1400&auto=format&fit=crop';
                @endphp
                <div class="mb-4">
                    <img id="main-image" src="{{ $primaryImageUrl }}" class="property-main-img shadow-lg" alt="{{ $property->title }}">
                </div>

                <!-- Gallery -->
                @if($images->count() > 0)
                    <div class="row g-3 mb-5">
                        @foreach($images as $img)
                            <div class="col-3 col-md-2">
                                <img src="{{ asset('storage/' . $img->path) }}" class="thumb-img shadow-sm" onclick="document.getElementById('main-image').src = this.src">
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Specs -->
                <div class="row g-4 mb-5 text-center">
                    <div class="col-4 col-md-3">
                        <div class="spec-card">
                            <div class="small text-muted fw-bold mb-1">BEDROOMS</div>
                            <div class="h4 fw-bold mb-0 text-dark">{{ $property->bedrooms ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="spec-card">
                            <div class="small text-muted fw-bold mb-1">BATHROOMS</div>
                            <div class="h4 fw-bold mb-0 text-dark">{{ $property->bathrooms ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="spec-card">
                            <div class="small text-muted fw-bold mb-1">AREA</div>
                            <div class="h4 fw-bold mb-0 text-dark">{{ number_format($property->sqft ?? 0) }} SF</div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <h3 class="fw-bold text-dark mb-4">Description</h3>
                    <p class="fs-5 text-secondary lh-lg" style="white-space: pre-line;">
                        {{ $property->description }}
                    </p>
                </div>
            </div>

            <!-- Right Side - Inquiry & Listing Info -->
            <div class="col-lg-4">
                <div class="card inquiry-card border-0 shadow-lg bg-white p-4">
                    <div class="mb-4">
                        <h4 class="fw-bold text-dark mb-3">Listed by</h4>
                        <div class="d-flex align-items-center gap-3 bg-light rounded-4 p-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 48px; height: 48px;">
                                {{ substr($property->owner->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $property->owner->name }}</div>
                                <div class="small text-muted">Verified Seller</div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-10">

                    <h5 class="fw-bold text-dark mb-3">Interested in this property?</h5>
                    @auth
                        @if(auth()->user()->role === \App\Models\User::ROLE_BUYER)
                            <form action="{{ route('inquiry.send') }}" method="POST">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <div class="mb-3">
                                    <textarea name="message" rows="4" class="form-control" placeholder="I am interested in this property..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm">Send Inquiry</button>
                            </form>
                        @else
                            <div class="alert alert-light border-0 small text-muted text-center py-4 rounded-4">
                                Only registered buyers can send inquiries.
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4 bg-light rounded-4 mb-3">
                            <p class="small text-muted mb-3">Login to start a conversation</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary fw-bold px-4">Sign In</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
