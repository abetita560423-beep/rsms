<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-bold small text-uppercase text-muted">Full Name</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus autocomplete="name" />
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required autocomplete="username" />
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Account Type -->
        <div class="mb-4">
            <label for="role" class="form-label fw-bold small text-uppercase text-muted">I want to...</label>
            <select id="role" name="role" class="form-select" required>
                <option value="buyer" @selected(old('role', 'buyer') === 'buyer')>Buy / Rent Properties</option>
                <option value="seller" @selected(old('role') === 'seller')>Sell / Lease Properties</option>
            </select>
            @error('role')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-bold small text-uppercase text-muted">Password</label>
            <input id="password" class="form-control" type="password" name="password" placeholder="••••••••" required autocomplete="new-password" />
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-bold small text-uppercase text-muted">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
        </div>

        <div class="d-grid gap-2 mt-5 mb-4">
            <button type="submit" class="btn btn-primary shadow-sm">
                {{ __('Create Account') }}
            </button>
        </div>

        <div class="text-center mt-4">
            <p class="small text-muted mb-0">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Login</a>
            </p>
        </div>
    </form>
</x-guest-layout>
