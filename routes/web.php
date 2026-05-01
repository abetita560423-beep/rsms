<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ModerationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/explore', [PropertyController::class, 'catalog'])->name('properties.listing');
Route::get('/property/{property}', [PropertyController::class, 'show'])->name('property.details');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('dashboard.admin');

    Route::get('/dashboard/staff', [DashboardController::class, 'staff'])
        ->middleware('role:admin,staff')
        ->name('dashboard.staff');

    Route::get('/dashboard/seller', [DashboardController::class, 'seller'])
        ->middleware('role:admin,seller')
        ->name('dashboard.seller');

    Route::post('/inquiry/send', [InquiryController::class, 'store'])->name('inquiry.send');
    Route::get('/inquiry/{inquiry}', [InquiryController::class, 'show'])->name('inquiry.show');
    Route::post('/inquiry/{inquiry}/reply', [InquiryController::class, 'reply'])->name('inquiry.reply');
    Route::delete('/inquiry/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiry.destroy');
    Route::get('/seller/inquiries', [InquiryController::class, 'sellerInbox'])->name('seller.inquiries');
    Route::get('/buyer/inquiries', [InquiryController::class, 'buyerSent'])->name('buyer.inquiries');
    Route::post('/inquiry/{inquiry}/read', [InquiryController::class, 'markAsRead'])->name('inquiry.mark-read');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/seller/transactions', [TransactionController::class, 'sellerTransactions'])->name('seller.transactions');
    Route::get('/buyer/transactions', [TransactionController::class, 'buyerTransactions'])->name('buyer.transactions');
    Route::post('/transactions/payment-request', [TransactionController::class, 'sendPaymentRequest'])->name('transactions.payment-request');
    Route::post('/transactions/{deal}/confirm', [TransactionController::class, 'confirm'])->name('transactions.confirm');
    Route::post('/transactions/{deal}/finalize', [TransactionController::class, 'finalize'])->name('transactions.finalize');
});

Route::middleware(['auth', 'role:admin,staff,seller'])->group(function () {
    Route::resource('properties', PropertyController::class);
});

// Admin + Staff Moderation
Route::middleware(['auth', 'role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/properties', [ModerationController::class, 'allProperties'])->name('properties.index');
    Route::get('/properties/pending', [ModerationController::class, 'pendingProperties'])->name('properties.pending');
    Route::post('/property/{property}/approve', [ModerationController::class, 'approve'])->name('property.approve');
    Route::post('/property/{property}/reject', [ModerationController::class, 'reject'])->name('property.reject');
    Route::delete('/property/{property}', [ModerationController::class, 'destroy'])->name('property.destroy');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});

// Admin only User Management
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class)->except(['show', 'edit', 'update']);
    Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.update-role');
});

require __DIR__.'/auth.php';
