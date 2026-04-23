@extends('layouts.public')

@section('title', 'SummitHub | Premier Real Estate Marketplace')

@section('content')
    <style>
        .hero-section {
            padding: 120px 0;
            background: radial-gradient(circle at top right, rgba(10, 66, 151, 0.08), transparent),
                        radial-gradient(circle at bottom left, rgba(10, 66, 151, 0.08), transparent);
            position: relative;
        }
        .hero-title {
            font-size: 4.5rem;
            line-height: 1;
            letter-spacing: -0.05em;
        }
        @media (max-width: 768px) {
            .hero-title { font-size: 3rem; }
        }
        .search-container {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 1rem;
            box-shadow: 0 30px 60px -12px rgba(0,0,0,0.12);
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }
        .stats-card {
            border-radius: 1.25rem;
            border: 1px solid #eef2f7;
            background: #ffffff;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        .stats-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-5px);
        }
        .category-card {
            border-radius: 1.5rem;
            overflow: hidden;
            position: relative;
            height: 300px;
            display: block;
            text-decoration: none;
            transition: all 0.4s ease;
        }
        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .category-card:hover img { transform: scale(1.1); }
        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
        }
        .testimonial-card {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
        }
        .feature-icon {
            width: 64px;
            height: 64px;
            background: rgba(10, 66, 151, 0.05);
            color: var(--primary-color);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
    </style>

    {{-- Hero --}}
    <section class="hero-section text-center">
        <div class="container">
            <span class="badge bg-primary bg-opacity-10 text-primary mb-4 px-3 py-2 rounded-pill fw-bold">THE GOLD STANDARD</span>
            <h1 class="hero-title fw-bolder text-dark mb-4">Exceptional Properties <br/><span class="text-primary">Curated for You</span></h1>
            <p class="text-secondary mx-auto mb-0 fs-5" style="max-width: 700px;">
                Experience a seamless journey from discovery to acquisition. We bring together the most exclusive listings and serious buyers in a single, refined marketplace.
            </p>
        </div>
    </section>

    {{-- Search --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="search-container">
                    <form action="{{ route('properties.listing') }}" method="GET" class="row g-2">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0 ps-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="text-muted" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
                                </span>
                                <input type="text" name="search" class="form-control border-0 ps-0 py-3 shadow-none" placeholder="Search locations or property types...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="type" class="form-select border-0 py-3 shadow-none fw-semibold">
                                <option value="">Any Type</option>
                                <option value="sale">For Sale</option>
                                <option value="rent">For Rent</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100 h-100 rounded-4 fw-bold">Search Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Section --}}
    <section class="py-5 mt-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-6 col-lg-3">
                    <div class="stats-card">
                        <h2 class="display-6 fw-bolder text-primary mb-1">₱12.4B+</h2>
                        <p class="text-secondary small fw-bold text-uppercase mb-0">Total Asset Value</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stats-card">
                        <h2 class="display-6 fw-bolder text-primary mb-1">5.2k</h2>
                        <p class="text-secondary small fw-bold text-uppercase mb-0">Verified Sellers</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stats-card">
                        <h2 class="display-6 fw-bolder text-primary mb-1">150+</h2>
                        <p class="text-secondary small fw-bold text-uppercase mb-0">Luxury Developments</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stats-card">
                        <h2 class="display-6 fw-bolder text-primary mb-1">24/7</h2>
                        <p class="text-secondary small fw-bold text-uppercase mb-0">Elite Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold h1 tracking-tighter">Diverse Portfolio</h2>
                <p class="text-secondary mb-0">Find the space that fits your lifestyle perfectly.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="{{ route('properties.listing', ['category' => 'house']) }}" class="category-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=800&auto=format&fit=crop" alt="Houses">
                        <div class="category-overlay">
                            <h4 class="fw-bold mb-1">Modern Houses</h4>
                            <p class="small mb-0 opacity-75">Spacious living for growing families</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('properties.listing', ['category' => 'apartment']) }}" class="category-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1493809842364-78817add7ffb?q=80&w=800&auto=format&fit=crop" alt="Apartments">
                        <div class="category-overlay">
                            <h4 class="fw-bold mb-1">Luxury Apartments</h4>
                            <p class="small mb-0 opacity-75">Urban elegance in prime locations</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('properties.listing', ['category' => 'commercial']) }}" class="category-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop" alt="Commercial">
                        <div class="category-overlay">
                            <h4 class="fw-bold mb-1">Commercial Spaces</h4>
                            <p class="small mb-0 opacity-75">High-yield assets for your business</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Listings --}}
    <section class="py-5">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="fw-bold h1 tracking-tighter">Featured Estates</h2>
                    <p class="text-secondary mb-0">The highest standard of modern living</p>
                </div>
                <a href="{{ route('properties.listing') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold shadow-sm">Explore Catalog</a>
            </div>

            <div class="row g-4">
                @forelse($featuredProperties as $property)
                    @php
                        $imageUrl = $property->image 
                            ? asset('storage/' . $property->image) 
                            : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&auto=format&fit=crop';
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift bg-white">
                            <div class="position-relative" style="height: 240px;">
                                <img src="{{ $imageUrl }}" class="w-100 h-100 object-fit-cover" alt="{{ $property->title }}">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-white text-primary shadow-sm">{{ strtoupper($property->type) }}</span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="text-primary" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                                    <span class="small text-muted fw-bold">{{ $property->location }}</span>
                                </div>
                                <h4 class="fw-bold text-dark mb-3">{{ $property->title }}</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-3">
                                        <div class="text-center">
                                            <div class="small text-muted opacity-75 fw-bold" style="font-size: 10px;">BEDS</div>
                                            <div class="fw-bold">{{ $property->bedrooms ?? 0 }}</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="small text-muted opacity-75 fw-bold" style="font-size: 10px;">BATHS</div>
                                            <div class="fw-bold">{{ $property->bathrooms ?? 0 }}</div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="text-primary fw-bolder fs-4">₱{{ number_format($property->price, 0) }}</div>
                                    </div>
                                </div>
                                <hr class="my-4 opacity-10">
                                <a href="{{ route('property.details', $property) }}" class="btn btn-light w-100 py-2.5 fw-bold text-primary rounded-3">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">New properties are arriving soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold h1 tracking-tighter">Trusted by Thousands</h2>
                <p class="text-secondary mb-0">Hear from our clients who found their legacy homes.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="text-primary mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16"><path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z"/></svg>
                        </div>
                        <p class="text-secondary fs-5 mb-4 italic">"The process was incredibly smooth. I found my dream penthouse in BGC within a week!"</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 48px; height: 48px;">M</div>
                            <div>
                                <div class="fw-bold text-dark">Michael Chen</div>
                                <div class="small text-muted">Investor, Makati</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="text-primary mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16"><path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z"/></svg>
                        </div>
                        <p class="text-secondary fs-5 mb-4">"As a seller, the verification process gave me confidence that I was dealing with serious buyers."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 48px; height: 48px;">S</div>
                            <div>
                                <div class="fw-bold text-dark">Sophia Rodriguez</div>
                                <div class="small text-muted">Property Developer</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="text-primary mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16"><path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z"/></svg>
                        </div>
                        <p class="text-secondary fs-5 mb-4">"Transparent, fast, and professional. Summit Estate is the only platform I use for my rentals."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 48px; height: 48px;">D</div>
                            <div>
                                <div class="fw-bold text-dark">David Wilson</div>
                                <div class="small text-muted">Expat, Taguig</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-5 mb-5">
        <div class="container">
            <div class="bg-primary rounded-5 p-5 text-white text-center shadow-lg position-relative overflow-hidden">
                <div class="position-relative z-1 py-4">
                    <h2 class="display-4 fw-bold mb-4 tracking-tighter">Ready to Find Your <br/>Dream Estate?</h2>
                    <p class="fs-5 opacity-75 mb-5 mx-auto" style="max-width: 600px;">
                        Join thousands of satisfied users and start your property journey today.
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('properties.listing') }}" class="btn btn-light btn-lg px-5 fw-bold text-primary rounded-pill shadow-sm">Start Browsing</a>
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5 fw-bold rounded-pill">Sign Up Now</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
