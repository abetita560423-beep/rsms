<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register and default to buyer role', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));

    expect(auth()->user()->role)->toBe(User::ROLE_BUYER);
});

test('new users can register as seller', function () {
    $response = $this->post('/register', [
        'name' => 'Seller User',
        'email' => 'seller@example.com',
        'role' => User::ROLE_SELLER,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));

    expect(auth()->user()->role)->toBe(User::ROLE_SELLER);
});

test('users cannot self assign admin role during registration', function () {
    $response = $this->from(route('register'))->post('/register', [
        'name' => 'Bad Actor',
        'email' => 'bad@example.com',
        'role' => User::ROLE_ADMIN,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors('role');
});
