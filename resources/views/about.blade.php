@extends('layouts.public')

@section('title', 'About Us | SummitHub')

@section('content')
    <style>
        .timeline {
            position: relative;
            padding: 2rem 0;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #eef2f7;
            transform: translateX(-50%);
        }
        .timeline-item {
            margin-bottom: 3rem;
            position: relative;
        }
        .timeline-dot {
            width: 16px;
            height: 16px;
            background: var(--primary-color);
            border-radius: 50%;
            position: absolute;
            left: 50%;
            top: 10px;
            transform: translateX(-50%);
            z-index: 1;
            border: 4px solid #fff;
            box-shadow: 0 0 0 4px rgba(10, 66, 151, 0.1);
        }
        .team-img {
            height: 350px;
            width: 100%;
            object-fit: cover;
            border-radius: 2rem;
            transition: all 0.3s ease;
        }
        .team-card:hover .team-img {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>

    <div class="bg-white border-bottom py-5 mb-5">
        <div class="container text-center">
            <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 rounded-pill fw-bold">OUR STORY</span>
            <h1 class="display-4 fw-bolder tracking-tighter mb-4">Elevating the Standard of <br/><span class="text-primary">Real Estate Excellence</span></h1>
            <p class="text-secondary mx-auto fs-5" style="max-width: 700px;">
                Summit Estate is a dedicated ecosystem designed to connect discerning buyers with the most exclusive properties across the Philippines.
            </p>
        </div>
    </div>

    <div class="container pb-5">
        {{-- Mission/Vision --}}
        <div class="row g-5 align-items-center mb-5 pb-5">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200&auto=format&fit=crop" class="img-fluid rounded-5 shadow-lg" alt="Modern Architecture">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold h1 tracking-tighter mb-4">Our Mission</h2>
                <p class="text-secondary fs-5 mb-4">
                    Our mission is to simplify the complex world of real estate through transparency, technology, and trust. We believe that finding your dream home should be a rewarding experience.
                </p>
                <div class="row g-4">
                    <div class="col-6">
                        <div class="h3 fw-bold text-primary mb-1">15k+</div>
                        <div class="small text-muted fw-bold text-uppercase">Homes Sold</div>
                    </div>
                    <div class="col-6">
                        <div class="h3 fw-bold text-primary mb-1">98%</div>
                        <div class="small text-muted fw-bold text-uppercase">Happy Clients</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Team Section --}}
        <div class="py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold h1 tracking-tighter">Meet Our Leadership</h2>
                <p class="text-secondary">The visionaries behind the Philippines' premier property marketplace.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="team-card text-center">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=600&auto=format&fit=crop" class="team-img mb-4" alt="CEO">
                        <h4 class="fw-bold mb-1">Alexander Vance</h4>
                        <p class="text-primary fw-bold small text-uppercase">Founder & CEO</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-card text-center">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=600&auto=format&fit=crop" class="team-img mb-4" alt="COO">
                        <h4 class="fw-bold mb-1">Elena Rodriguez</h4>
                        <p class="text-primary fw-bold small text-uppercase">Chief Operations</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-card text-center">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=600&auto=format&fit=crop" class="team-img mb-4" alt="CTO">
                        <h4 class="fw-bold mb-1">Marcus Thorne</h4>
                        <p class="text-primary fw-bold small text-uppercase">Chief Technology</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="py-5 my-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold h1 tracking-tighter">Our Journey</h2>
                <p class="text-secondary">From a small startup to a national industry leader.</p>
            </div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="row">
                        <div class="col-md-6 text-md-end pe-md-5 mb-3 mb-md-0">
                            <h4 class="fw-bold text-primary">2018</h4>
                        </div>
                        <div class="col-md-6 ps-md-5">
                            <h5 class="fw-bold">Foundation</h5>
                            <p class="text-secondary small">Summit Estate was founded in Makati with a vision to digitize luxury property transactions.</p>
                        </div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="row">
                        <div class="col-md-6 text-md-end pe-md-5 mb-3 mb-md-0">
                            <h4 class="fw-bold text-primary">2020</h4>
                        </div>
                        <div class="col-md-6 ps-md-5">
                            <h5 class="fw-bold">Digital Expansion</h5>
                            <p class="text-secondary small">Launched our advanced inquiry system, connecting thousands of buyers during the global shift to digital.</p>
                        </div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="row">
                        <div class="col-md-6 text-md-end pe-md-5 mb-3 mb-md-0">
                            <h4 class="fw-bold text-primary">2023</h4>
                        </div>
                        <div class="col-md-6 ps-md-5">
                            <h5 class="fw-bold">Market Leadership</h5>
                            <p class="text-secondary small">Recognized as the most trusted property marketplace in the Philippines with over 10k verified listings.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
