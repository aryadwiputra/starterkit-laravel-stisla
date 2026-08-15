<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

Route::middleware('guest')->group(function () {
    Fortify::loginView(fn() => view('auth.login'));
    Fortify::registerView(fn() => view('auth.register'));
    Fortify::requestPasswordResetLinkView(fn() => view('auth.forgot'));
    Fortify::resetPasswordView(fn($token) => view('auth.reset', ['token' => $token]));
});

Route::middleware('auth')->group(function () {
    Route::get('/', fn() => view('pages.dashboard'))->name('dashboard');

    Route::middleware(['permission:orders.view'])->group(function () {
        Route::get('/orders', fn() => view('pages.orders.index'))->name('orders.index');
    });
    Route::middleware(['permission:orders.create'])->group(function () {
        Route::get('/orders/new', fn() => view('pages.orders.create'))->name('orders.create');
    });
    Route::get('/orders/export', fn() => view('pages.orders.index'))->name('orders.export');
    Route::middleware(['permission:orders.update'])->group(function () {
        Route::get('/orders/{id}', fn($id) => view('pages.orders.detail', ['id' => $id]))->name('orders.show');
    });

    Route::middleware(['permission:products.view'])->group(function () {
        Route::get('/products', fn() => view('pages.products.index'))->name('products.index');
    });
    Route::middleware(['permission:products.create'])->group(function () {
        Route::get('/products/new', fn() => view('pages.products.create'))->name('products.create');
    });
    Route::get('/products/export', fn() => view('pages.products.index'))->name('products.export');
    Route::middleware(['permission:products.edit'])->group(function () {
        Route::get('/products/{id}/edit', fn($id) => view('pages.products.create', ['id' => $id]))->name('products.edit');
    });

    Route::middleware(['permission:customers.view'])->group(function () {
        Route::get('/customers', fn() => view('pages.customers'))->name('customers');
    });

    Route::middleware(['permission:reports.view'])->group(function () {
        Route::get('/reports', fn() => view('pages.reports'))->name('reports');
    });

    Route::middleware(['permission:profile.view'])->group(function () {
        Route::get('/profile', fn() => view('pages.profile'))->name('profile');
    });

    Route::middleware(['permission:settings.view'])->group(function () {
        Route::get('/settings', fn() => view('pages.settings'))->name('settings');
    });

    Route::get('/blank', fn() => view('pages.blank'))->name('blank');

    Route::middleware(['permission:users.view'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
    Route::middleware(['permission:users.create'])->group(function () {
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });
    Route::middleware(['permission:users.edit'])->group(function () {
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    });
    Route::middleware(['permission:users.delete'])->group(function () {
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::post('/logout', [Fortify::class, 'logout'])->name('logout')->withoutMiddleware('auth');
});

Route::get('/403', fn() => view('pages.errors.403'))->name('error.403');
Route::get('/404', fn() => view('pages.errors.404'))->name('error.404');
Route::get('/500', fn() => view('pages.errors.500'))->name('error.500');
