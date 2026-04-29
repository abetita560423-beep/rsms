@extends('layouts.public')

@section('title', 'Login - SummitHub')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">
        <!-- Left Column: Login Form -->
        <div class="col-lg-5 d-flex flex-column justify-content-center px-4 px-md-5 py-5 bg-white">
            <div class="w-100 mx-auto" style="max-width: 450px;">
                
                <button onclick="goBack()" class="btn btn-link text-decoration-none text-muted p-0 mb-4 d-flex align-items-center gap-2 fw-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                    <span>Back</span>
                </button>

                <div class="mb-5">
                    <h2 class="fs-2 fw-bold text-dark mb-2">Welcome Back</h2>
                    <p class="text-secondary">Please enter your details to sign in to your account.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold small text-uppercase text-muted">Email Address</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            class="form-control form-control-lg bg-light border-0"
                            required
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold small text-uppercase text-muted">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="••••••••"
                            class="form-control form-control-lg bg-light border-0"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- REMEMBER & FORGOT PASSWORD -->
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <div class="form-check">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                class="form-check-input"
                            >
                            <label for="remember" class="form-check-label small text-secondary fw-medium">
                                Remember me
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-primary text-decoration-none fw-semibold">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- SUBMIT -->
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-pill shadow-sm">
                            Sign In
                        </button>
                    </div>
                </form>

                <!-- REGISTER LINK -->
                <div class="text-center mt-5">
                    <p class="small text-secondary mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">
                            Create an account
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Column: Image & Banner -->
        <div class="col-lg-7 d-none d-lg-block position-relative">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&auto=format&fit=crop" class="w-100 h-100 object-fit-cover" alt="Luxury Real Estate">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(10, 66, 151, 0.85) 0%, rgba(8, 54, 122, 0.6) 100%);"></div>
            
            <div class="position-absolute bottom-0 start-0 w-100 p-5 text-white">
                <div class="ms-4 mb-5" style="max-width: 500px;">
                    <h3 class="display-5 fw-bold mb-3">Discover Your Next Dream Home</h3>
                    <p class="fs-5 text-white-50">Join SummitHub to access exclusive property listings, connect directly with sellers, and manage your real estate journey.</p>
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