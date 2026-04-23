<?php

use App\Models\User;

test('dashboard redirects users by role', function (string $role, string $routeName) {
    $user = User::factory()->create([
        'role' => $role,
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertRedirect(route($routeName, absolute: false));
})->with([
    [User::ROLE_ADMIN, 'dashboard.admin'],
    [User::ROLE_STAFF, 'dashboard.staff'],
]);

test('buyers and sellers stay on /dashboard', function (string $role) {
    $user = User::factory()->create([
        'role' => $role,
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk();
})->with([
    User::ROLE_BUYER,
    User::ROLE_SELLER,
]);

test('admin and staff dashboards are protected by role middleware', function () {
    $buyer = User::factory()->create(['role' => User::ROLE_BUYER]);
    $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    $staff = User::factory()->create(['role' => User::ROLE_STAFF]);

    $this->actingAs($buyer)->get('/dashboard/admin')->assertForbidden();
    $this->actingAs($buyer)->get('/dashboard/staff')->assertForbidden();

    $this->actingAs($admin)->get('/dashboard/admin')->assertOk();
    $this->actingAs($staff)->get('/dashboard/staff')->assertOk();
});
