<x-app-layout>
    <x-slot name="header">
        {{ __('Account Settings') }}
    </x-slot>

    <div class="row g-4 justify-content-center py-4">
        <div class="col-lg-8">
            <!-- Profile Info -->
            <div class="card p-4 mb-4">
                <h4 class="fw-bold text-dark mb-4">Profile Information</h4>
                <p class="text-secondary small mb-4">Update your account's profile information and email address.</p>

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold small text-muted text-uppercase">Full Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold small text-muted text-uppercase">Email Address</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4 fw-bold rounded-pill">Save Changes</button>
                        @if (session('status') === 'profile-updated')
                            <span class="text-success small fw-bold">Saved.</span>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Password Update -->
            <div class="card p-4 mb-4">
                <h4 class="fw-bold text-dark mb-4">Update Password</h4>
                <p class="text-secondary small mb-4">Ensure your account is using a long, random password to stay secure.</p>

                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="update_password_current_password" class="form-label fw-bold small text-muted text-uppercase">Current Password</label>
                        <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                        @error('current_password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password" class="form-label fw-bold small text-muted text-uppercase">New Password</label>
                        <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                        @error('password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="update_password_password_confirmation" class="form-label fw-bold small text-muted text-uppercase">Confirm Password</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                        @error('password_confirmation', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4 fw-bold rounded-pill">Update Password</button>
                        @if (session('status') === 'password-updated')
                            <span class="text-success small fw-bold">Updated.</span>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Delete Account -->
            <div class="card p-4 border-danger border-opacity-10 bg-danger bg-opacity-10">
                <h4 class="fw-bold text-danger mb-4">Delete Account</h4>
                <p class="text-dark small mb-4">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="mb-4">
                        <input id="password" name="password" type="password" class="form-control border-danger border-opacity-25" placeholder="Enter password to confirm..." required />
                        @error('password', 'userDeletion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger px-4 fw-bold rounded-pill" onclick="return confirm('This action cannot be undone. Delete account?')">
                            Delete Account Permanently
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
