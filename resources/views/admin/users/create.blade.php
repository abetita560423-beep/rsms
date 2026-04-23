<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-dark mb-0">
            {{ __('Create New User') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small text-muted text-uppercase">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold small text-muted text-uppercase">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label for="role" class="form-label fw-bold small text-muted text-uppercase">User Role</label>
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="" disabled selected>Select a role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" @selected(old('role') === $role)>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4 opacity-10">

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold small text-muted text-uppercase">Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold small text-muted text-uppercase">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-4">
                            <a class="text-muted small text-decoration-none" href="{{ route('admin.users.index') }}">
                                {{ __('Back to Users') }}
                            </a>

                            <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                                {{ __('Create User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
