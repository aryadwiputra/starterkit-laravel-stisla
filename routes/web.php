<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', fn () => view('pages.dashboard'))->name('dashboard');

// Store
Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', fn () => view('pages.orders.index'))->name('index');
    Route::get('/new', fn () => view('pages.orders.create'))->name('create');
    Route::get('/export', fn () => view('pages.orders.index'))->name('export');
    Route::get('/{id}', fn ($id) => view('pages.orders.detail', ['id' => $id]))->name('show');
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', fn () => view('pages.products.index'))->name('index');
    Route::get('/new', fn () => view('pages.products.create'))->name('create');
    Route::get('/export', fn () => view('pages.products.index'))->name('export');
    Route::get('/{id}/edit', fn ($id) => view('pages.products.create', ['id' => $id]))->name('edit');
});

Route::get('/customers', fn () => view('pages.customers'))->name('customers');

// Insights
Route::get('/reports', fn () => view('pages.reports'))->name('reports');

// Pages
Route::get('/profile', fn () => view('pages.profile'))->name('profile');
Route::get('/settings', fn () => view('pages.settings'))->name('settings');
Route::get('/blank', fn () => view('pages.blank'))->name('blank');

// Auth (placeholder routes - no middleware)
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::get('/forgot-password', fn () => view('auth.forgot'))->name('password.request');
Route::post('/forgot-password', fn () => view('auth.forgot'))->name('password.email');

// Error Pages
Route::get('/403', fn () => view('pages.errors.403'))->name('error.403');
Route::get('/404', fn () => view('pages.errors.404'))->name('error.404');
Route::get('/500', fn () => view('pages.errors.500'))->name('error.500');
