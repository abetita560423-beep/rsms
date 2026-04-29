@extends('layouts.public')

@section('title', 'Register - SummitHub')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">
        <!-- Left Column: Image & Banner -->
        <div class="col-lg-6 d-none d-lg-block position-relative">
            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1200&auto=format&fit=crop" class="w-100 h-100 object-fit-cover" alt="Modern Architecture">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(10, 66, 151, 0.9) 0%, rgba(8, 54, 122, 0.7) 100%);"></div>
            
            <div class="position-absolute bottom-0 start-0 w-100 p-5 text-white">
                <div class="ms-4 mb-5" style="max-width: 500px;">
                    <h3 class="display-5 fw-bold mb-3">Your Journey Starts Here</h3>
                    <p class="fs-5 text-white-50">Create an account to start buying, selling, or renting properties with SummitHub. Connect with a massive network of real estate professionals.</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Register Form -->
        <div class="col-lg-6 d-flex flex-column justify-content-center px-4 px-md-5 py-5 bg-white">
            <div class="w-100 mx-auto" style="max-width: 500px;">
                
                <button onclick="goBack()" class="btn btn-link text-decoration-none text-muted p-0 mb-4 d-flex align-items-center gap-2 fw-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                    <span>Back</span>
                </button>

                <div class="mb-5">
                    <h2 class="fs-2 fw-bold text-dark mb-2">Create Account</h2>
                    <p class="text-secondary">Fill in your details below to get started.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold small text-uppercase text-muted">Full Name</label>
                        <input id="name" class="form-control form-control-lg bg-light border-0" type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus autocomplete="name" />
                        @error('name')
                            <div class="text-danger small mt-1 fw-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold small text-uppercase text-muted">Email Address</label>
                        <input id="email" class="form-control form-control-lg bg-light border-0" type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required autocomplete="username" />
                        @error('email')
                            <div class="text-danger small mt-1 fw-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Account Type -->
                    <div class="mb-4">
                        <label for="role" class="form-label fw-semibold small text-uppercase text-muted">I want to...</label>
                        <select id="role" name="role" class="form-select form-select-lg bg-light border-0" required>
                            <option value="buyer" @selected(old('role', 'buyer') === 'buyer')>Buy / Rent Properties</option>
                            <option value="seller" @selected(old('role') === 'seller')>Sell / Lease Properties</option>
                        </select>
                        @error('role')
                            <div class="text-danger small mt-1 fw-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-5">
                        <!-- Password -->
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold small text-uppercase text-muted">Password</label>
                            <input id="password" class="form-control form-control-lg bg-light border-0" type="password" name="password" placeholder="••••••••" required autocomplete="new-password" />
                            @error('password')
                                <div class="text-danger small mt-1 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold small text-uppercase text-muted">Confirm Password</label>
                            <input id="password_confirmation" class="form-control form-control-lg bg-light border-0" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-pill shadow-sm">
                            Create Account
                        </button>
                    </div>
                </form>

                <!-- LOGIN LINK -->
                <div class="text-center mt-4">
                    <p class="small text-secondary mb-0">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function goBack() {
        let referrer = document.referrer;
        if (referrer.includes('/login') || referrer.includes('/register')) {
            window.location.href = '/';
        } else if (referrer) {
            window.history.back();
        } else {
            window.location.href = '/';
        }
    }
</script>
@endsection
