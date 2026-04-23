<x-guest-layout>
    <!-- HEADER -->
    <div class="text-center mb-5">
        <h2 class="fs-3 fw-bold text-dark mb-1">Summit Estate</h2>
        <p class="text-secondary small">Welcome back! Please enter your details.</p>
    </div>

    <!-- FORM -->
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

        <!-- REMEMBER -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input
                    id="remember"
                    name="remember"
                    type="checkbox"
                    class="form-check-input"
                >
                <label for="remember" class="form-check-label small text-secondary">
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
            <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                Sign In
            </button>
        </div>
    </form>

    <!-- REGISTER LINK -->
    <div class="text-center">
        <p class="small text-secondary mb-0">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">
                Register
            </a>
        </p>
    </div>
</x-guest-layout>