# RBAC + User Management Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Implement RBAC with Spatie Permission, DataTable for user management, integrate into settings page.

**Architecture:** Install spatie/laravel-permission and yajra/laravel-datatables, create migrations for roles/permissions tables, seed default roles (Admin, Staff) with permissions, protect routes with middleware, create DataTable for users management, integrate into settings page.

**Tech Stack:** Laravel 13, spatie/laravel-permission, yajra/laravel-datatables-oracle, Laravel Fortify

## Global Constraints

- PHP 8.3+
- Laravel 13.17+
- spatie/laravel-permission (latest)
- yajra/laravel-datatables-oracle (latest)

---

## Task 1: Install Packages

**Files:**
- Modify: `composer.json`
- Create: `composer.lock` (updated)

- [ ] **Step 1: Install spatie/laravel-permission**

```bash
composer require spatie/laravel-permission
```

- [ ] **Step 2: Install yajra/laravel-datatables**

```bash
composer require yajra/laravel-datatables-oracle
```

- [ ] **Step 3: Publish spatie config**

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

- [ ] **Step 4: Publish datatables config**

```bash
php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"
```

- [ ] **Step 5: Commit**

```bash
git add composer.json composer.lock
git commit -m "chore(deps): add spatie/laravel-permission and yajra/laravel-datatables"
```

---

## Task 2: Create Migrations

**Files:**
- Create: `database/migrations/create_roles_and_permissions_tables.php`
- Modify: `database/migrations/2026_08_15_080353_add_two_factor_columns_to_users_table.php` (delete)
- Modify: `database/migrations/2026_08_15_080354_create_passkeys_table.php` (delete)

- [ ] **Step 1: Create roles and permissions migration**

```bash
php artisan make:migration create_roles_and_permissions_tables
```

Edit the migration file to:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
            $table->primary(['permission_id', 'role_id']);
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type']);
            $table->primary(['role_id', 'model_id', 'model_type']);
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type']);
            $table->primary(['permission_id', 'model_id', 'model_type']);
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
```

- [ ] **Step 2: Delete old migrations**

```bash
rm database/migrations/2026_08_15_080353_add_two_factor_columns_to_users_table.php
rm database/migrations/2026_08_15_080354_create_passkeys_table.php
```

- [ ] **Step 3: Run migrations**

```bash
php artisan migrate:fresh
```

- [ ] **Step 4: Commit**

```bash
git add database/migrations/create_roles_and_permissions_tables.php
git rm database/migrations/2026_08_15_080353_add_two_factor_columns_to_users_table.php
git rm database/migrations/2026_08_15_080354_create_passkeys_table.php
git commit -m "feat(rbac): add roles and permissions tables
- Create roles, permissions tables
- Create pivot tables for many-to-many relationships
- Remove old fortify two_factor and passkeys migrations"
```

---

## Task 3: Update User Model

**Files:**
- Modify: `app/Models/User.php`

- [ ] **Step 1: Update User model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

- [ ] **Step 2: Commit**

```bash
git add app/Models/User.php
git commit -m "feat(rbac): add HasRoles trait to User model"
```

---

## Task 4: Create Seeders

**Files:**
- Create: `database/seeders/PermissionSeeder.php`
- Create: `database/seeders/RoleSeeder.php`
- Modify: `database/seeders/DatabaseSeeder.php`

- [ ] **Step 1: Create PermissionSeeder**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            // Orders
            'orders.view',
            'orders.create',
            'orders.update',
            'orders.delete',
            // Products
            'products.view',
            'products.create',
            'products.update',
            'products.delete',
            // Customers
            'customers.view',
            'customers.create',
            'customers.edit',
            'customers.delete',
            // Reports
            'reports.view',
            // Profile
            'profile.view',
            'profile.edit',
            // Settings
            'settings.view',
            'settings.edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
```

- [ ] **Step 2: Create RoleSeeder**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        // Admin: all permissions
        $adminPermissions = [
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'orders.view', 'orders.create', 'orders.update', 'orders.delete',
            'products.view', 'products.create', 'products.update', 'products.delete',
            'customers.view', 'customers.create', 'customers.edit', 'customers.delete',
            'reports.view',
            'profile.view', 'profile.edit',
            'settings.view', 'settings.edit',
        ];
        $admin->syncPermissions($adminPermissions);

        // Staff: limited permissions
        $staffPermissions = [
            'orders.view', 'orders.create', 'orders.update',
            'products.view',
            'customers.view',
            'reports.view',
            'profile.view', 'profile.edit',
            'settings.view',
        ];
        $staff->syncPermissions($staffPermissions);
    }
}
```

- [ ] **Step 3: Update DatabaseSeeder**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
```

- [ ] **Step 4: Update AdminSeeder to assign role**

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@meridian.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $staff = User::create([
            'name' => 'Staff',
            'email' => 'staff@meridian.com',
            'password' => Hash::make('password'),
        ]);
        $staff->assignRole('staff');
    }
}
```

- [ ] **Step 5: Run seeders**

```bash
php artisan db:seed --force
```

- [ ] **Step 6: Commit**

```bash
git add database/seeders/PermissionSeeder.php database/seeders/RoleSeeder.php database/seeders/AdminSeeder.php database/seeders/DatabaseSeeder.php
git commit -m "feat(rbac): add permission and role seeders
- PermissionSeeder: create all permissions
- RoleSeeder: create admin and staff roles with permissions
- AdminSeeder: assign admin role to default admin user
- Add staff user for testing"
```

---

## Task 5: Create Middleware

**Files:**
- Create: `app/Http/Middleware/CheckRole.php`
- Create: `app/Http/Middleware/CheckPermission.php`
- Modify: `bootstrap/app.php`

- [ ] **Step 1: Create CheckRole middleware**

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || !$request->user()->hasRole($role)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
```

- [ ] **Step 2: Create CheckPermission middleware**

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!$request->user() || !$request->user()->can($permission)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
```

- [ ] **Step 3: Register middleware in bootstrap/app.php**

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

- [ ] **Step 4: Commit**

```bash
git add app/Http/Middleware/CheckRole.php app/Http/Middleware/CheckPermission.php bootstrap/app.php
git commit -m "feat(rbac): add role and permission middleware"
```

---

## Task 6: Update Routes with Middleware

**Files:**
- Modify: `routes/web.php`

- [ ] **Step 1: Update routes/web.php**

```php
<?php

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
        Route::middleware(['permission:orders.create'])->group(function () {
            Route::get('/orders/new', fn() => view('pages.orders.create'))->name('orders.create');
        });
        Route::get('/orders/export', fn() => view('pages.orders.index'))->name('orders.export');
        Route::middleware(['permission:orders.update'])->group(function () {
            Route::get('/orders/{id}', fn($id) => view('pages.orders.detail', ['id' => $id]))->name('orders.show');
        });
    });

    Route::middleware(['permission:products.view'])->group(function () {
        Route::get('/products', fn() => view('pages.products.index'))->name('products.index');
        Route::middleware(['permission:products.create'])->group(function () {
            Route::get('/products/new', fn() => view('pages.products.create'))->name('products.create');
        });
        Route::get('/products/export', fn() => view('pages.products.index'))->name('products.export');
        Route::middleware(['permission:products.edit'])->group(function () {
            Route::get('/products/{id}/edit', fn($id) => view('pages.products.create', ['id' => $id]))->name('products.edit');
        });
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

    Route::post('/logout', [Fortify::class, 'logout'])->name('logout')->withoutMiddleware('auth');
});

Route::get('/403', fn() => view('pages.errors.403'))->name('error.403');
Route::get('/404', fn() => view('pages.errors.404'))->name('error.404');
Route::get('/500', fn() => view('pages.errors.500'))->name('error.500');
```

- [ ] **Step 2: Commit**

```bash
git add routes/web.php
git commit -m "feat(rbac): protect routes with permission middleware"
```

---

## Task 7: Create UserController for DataTable

**Files:**
- Create: `app/Http/Controllers/UserController.php`
- Create: `app/DataTables/UserDataTable.php`

- [ ] **Step 1: Create UserDataTable**

```php
<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\QueryDataTable;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('roles', function ($user) {
                return $user->getRoleNames()->map(fn($role) => '<span class="badge badge--soft badge--primary">' . e($role) . '</span>')->join(' ');
            })
            ->addColumn('action', function ($user) {
                $buttons = '';

                if (Auth::user()->can('users.edit')) {
                    $buttons .= '<button type="button" class="button button--sm button--ghost button--neutral edit-user" data-id="' . $user->id . '">Edit</button>';
                }

                if (Auth::user()->can('users.delete') && $user->id !== Auth::id()) {
                    $buttons .= '<button type="button" class="button button--sm button--ghost button--danger delete-user" data-id="' . $user->id . '">Delete</button>';
                }

                return $buttons;
            })
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }

    public function query(): QueryBuilder
    {
        return User::query()->with('roles');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons([
                ['extend' => 'create', 'className' => 'button button--primary', 'action' => 'function(e, dt, node, config) { window.dispatchEvent(new CustomEvent("create-user")); }'],
            ]);
    }

    protected function getColumns(): array
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => '#', 'searchable' => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'roles', 'name' => 'roles.name', 'title' => 'Roles', 'searchable' => false, 'orderable' => false],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'searchable' => false, 'orderable' => false],
        ];
    }

    protected function filename(): string
    {
        return 'users_' . date('YmdHis');
    }
}
```

- [ ] **Step 2: Create UserController**

```php
<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('pages.users.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['roles']);

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['exists:roles,name'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        $user->syncRoles($validated['roles']);

        return response()->json(['message' => 'User updated successfully', 'user' => $user->load('roles')]);
    }

    public function destroy(User $user)
    {
        if ($user->id === auth::id()) {
            return response()->json(['message' => 'Cannot delete yourself'], 422);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
```

- [ ] **Step 3: Add routes for user management**

Add to routes/web.php inside auth middleware:

```php
Route::middleware(['permission:users.view'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::middleware(['permission:users.create'])->group(function () {
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });
    Route::middleware(['permission:users.edit'])->group(function () {
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    });
    Route::middleware(['permission:users.delete'])->group(function () {
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
```

- [ ] **Step 4: Commit**

```bash
git add app/Http/Controllers/UserController.php app/DataTables/UserDataTable.php routes/web.php
git commit -m "feat(users): create UserController and UserDataTable"
```

---

## Task 8: Create Blade Views for Users

**Files:**
- Create: `resources/views/pages/users/index.blade.php`
- Create: `resources/views/pages/users/create.blade.php`
- Create: `resources/views/pages/users/edit.blade.php`

- [ ] **Step 1: Create users/index.blade.php**

```php
@extends('layouts.app')

@section('content')
<div class="page__header">
    <h1 class="page__title">Users</h1>
</div>

<div class="page__body">
    <div class="card">
        <div class="card__body p-0">
            <table id="users-table" class="table" style="width: 100%"></table>
        </div>
    </div>
</div>

@include('pages.users.create')
@include('pages.users.edit')
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script>
window.addEventListener('create-user', function() {
    document.getElementById('createUserModal').classList.add('is-open');
});
</script>
@endpush
```

- [ ] **Step 2: Create users/create.blade.php**

```php
<div class="dialog" id="createUserModal" data-stisla-dialog aria-hidden="true">
    <div class="dialog__backdrop" data-stisla-dialog-close></div>
    <div class="dialog__panel dialog__panel--sm" role="dialog" aria-modal="true" aria-labelledby="createUserModalTitle">
        <div class="dialog__header">
            <h2 class="dialog__title" id="createUserModalTitle">Create User</h2>
            <button type="button" class="button button--ghost button--neutral button--icon-only" data-stisla-dialog-close aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="none" stroke="currentColor" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="createUserForm">
            @csrf
            <div class="dialog__body">
                <div class="field">
                    <label for="create-name" class="field__label">Name</label>
                    <input type="text" class="input" id="create-name" name="name" required>
                </div>
                <div class="field">
                    <label for="create-email" class="field__label">Email</label>
                    <input type="email" class="input" id="create-email" name="email" required>
                </div>
                <div class="field">
                    <label for="create-password" class="field__label">Password</label>
                    <input type="password" class="input" id="create-password" name="password" required>
                </div>
                <div class="field">
                    <label for="create-password_confirmation" class="field__label">Confirm Password</label>
                    <input type="password" class="input" id="create-password_confirmation" name="password_confirmation" required>
                </div>
                <div class="field">
                    <label for="create-roles" class="field__label">Roles</label>
                    <select class="input" id="create-roles" name="roles[]" multiple required>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
            </div>
            <div class="dialog__footer">
                <button type="button" class="button button--outline button--neutral" data-stisla-dialog-close>Cancel</button>
                <button type="submit" class="button button--primary">Create User</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('createUserForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    try {
        const response = await fetch('/users', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });

        if (response.ok) {
            document.getElementById('createUserModal').classList.remove('is-open');
            form.reset();
            $('#users-table').DataTable().ajax.reload();
        }
    } catch (error) {
        console.error('Error:', error);
    }
});
</script>
@endpush
```

- [ ] **Step 3: Create users/edit.blade.php**

```php
<div class="dialog" id="editUserModal" data-stisla-dialog aria-hidden="true">
    <div class="dialog__backdrop" data-stisla-dialog-close></div>
    <div class="dialog__panel dialog__panel--sm" role="dialog" aria-modal="true" aria-labelledby="editUserModalTitle">
        <div class="dialog__header">
            <h2 class="dialog__title" id="editUserModalTitle">Edit User</h2>
            <button type="button" class="button button--ghost button--neutral button--icon-only" data-stisla-dialog-close aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="none" stroke="currentColor" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="editUserForm">
            @csrf
            @method('PUT')
            <div class="dialog__body">
                <input type="hidden" id="edit-id" name="id">
                <div class="field">
                    <label for="edit-name" class="field__label">Name</label>
                    <input type="text" class="input" id="edit-name" name="name" required>
                </div>
                <div class="field">
                    <label for="edit-email" class="field__label">Email</label>
                    <input type="email" class="input" id="edit-email" name="email" required>
                </div>
                <div class="field">
                    <label for="edit-password" class="field__label">Password (leave blank to keep)</label>
                    <input type="password" class="input" id="edit-password" name="password">
                </div>
                <div class="field">
                    <label for="edit-roles" class="field__label">Roles</label>
                    <select class="input" id="edit-roles" name="roles[]" multiple required>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
            </div>
            <div class="dialog__footer">
                <button type="button" class="button button--outline button--neutral" data-stisla-dialog-close>Cancel</button>
                <button type="submit" class="button button--primary">Update User</button>
            </div>
        </form>
    </div>
</div>
```

- [ ] **Step 4: Commit**

```bash
git add resources/views/pages/users/
git commit -m "feat(users): create user management blade views"
```

---

## Task 9: Update Settings Page with Users Tab

**Files:**
- Modify: `resources/views/pages/settings.blade.php`

- [ ] **Step 1: Update settings.blade.php**

```php
@extends('layouts.app')

@section('content')
<header class="page__header">
    <h1 class="page__title">Settings</h1>
</header>

<div class="page__body">
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 xl:col-span-3">
            <div class="card">
                <div class="card__body p-2">
                    <nav class="nav nav--stacked">
                        <a href="#general" class="nav__item active">General</a>
                        @can('users.view')
                        <a href="#users" class="nav__item">Users</a>
                        @endcan
                        <a href="#appearance" class="nav__item">Appearance</a>
                        <a href="#notifications" class="nav__item">Notifications</a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-span-12 xl:col-span-9">
            <div class="card" id="general">
                <div class="card__header">
                    <h3 class="card__title">General Settings</h3>
                </div>
                <div class="card__body">
                    <form class="flex flex-col gap-4">
                        <div class="field">
                            <label for="store_name" class="field__label">Store Name</label>
                            <input type="text" class="input" id="store_name" name="store_name" value="Meridian Store"/>
                        </div>
                        <div class="field">
                            <label for="store_email" class="field__label">Store Email</label>
                            <input type="email" class="input" id="store_email" name="store_email" value="hello@meridian.com"/>
                        </div>
                        <button type="submit" class="button button--primary self-start">Save Changes</button>
                    </form>
                </div>
            </div>

            @can('users.view')
            <div class="card mt-4" id="users">
                <div class="card__header">
                    <h3 class="card__title">Users</h3>
                    @can('users.create')
                    <button type="button" class="button button--primary button--sm" onclick="document.getElementById('createUserModal').classList.add('is-open')">
                        Add User
                    </button>
                    @endcan
                </div>
                <div class="card__body p-0">
                    <table id="users-table" class="table" style="width: 100%"></table>
                </div>
            </div>
            @endcan

            <div class="card mt-4" id="appearance">
                <div class="card__header">
                    <h3 class="card__title">Appearance</h3>
                </div>
                <div class="card__body">
                    <div class="field">
                        <label class="field__label">Theme</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="theme" value="light" checked/>
                                <span>Light</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="theme" value="dark"/>
                                <span>Dark</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4" id="notifications">
                <div class="card__header">
                    <h3 class="card__title">Notifications</h3>
                </div>
                <div class="card__body">
                    <div class="flex flex-col gap-4">
                        <div class="field__item">
                            <input type="checkbox" id="email_notifications" checked/>
                            <label for="email_notifications">Email notifications</label>
                        </div>
                        <div class="field__item">
                            <input type="checkbox" id="order_alerts" checked/>
                            <label for="order_alerts">Order alerts</label>
                        </div>
                    </div>
                    <button type="submit" class="button button--primary mt-4">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.users.create')
@include('pages.users.edit')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @can('users.view')
    if (document.getElementById('users-table')) {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/users',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'roles', name: 'roles', searchable: false, orderable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', searchable: false, orderable: false },
            ]
        });

        $(document).on('click', '.edit-user', function() {
            var id = $(this).data('id');
            $.get('/users/' + id + '/edit', function(user) {
                $('#edit-id').val(user.id);
                $('#edit-name').val(user.name);
                $('#edit-email').val(user.email);
                $('#edit-roles').val(user.roles.map(r => r.name)).trigger('change');
                $('#editUserModal').addClass('is-open');
            });
        });

        $(document).on('click', '.delete-user', function() {
            if (confirm('Are you sure?')) {
                var id = $(this).data('id');
                $.ajax({
                    url: '/users/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function() {
                        $('#users-table').DataTable().ajax.reload();
                    }
                });
            }
        });

        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#edit-id').val();
            var formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: '/users/' + id,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    $('#editUserModal').removeClass('is-open');
                    $('#users-table').DataTable().ajax.reload();
                }
            });
        });
    }
    @endcan
});
</script>
@endpush
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/settings.blade.php
git commit -m "feat(settings): add users tab with DataTable integration"
```

---

## Task 10: Update Sidebar with @can Directives

**Files:**
- Modify: `resources/views/layouts/app.blade.php`

- [ ] **Step 1: Update sidebar menu items**

Wrap menu items with @can directives:

```php
@can('orders.view')
<li class="sidebar__item">
    <a class="sidebar__button {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
        ...
    </a>
</li>
@endcan

@can('users.view')
<li class="sidebar__item">
    <a class="sidebar__button {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
        ...
    </a>
</li>
@endcan
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/layouts/app.blade.php
git commit -m "feat(rbac): protect sidebar menu items with @can directives"
```

---

## Task 11: Run Tests

**Files:**
- Create: `tests/Feature/UserManagementTest.php`

- [ ] **Step 1: Create test file**

```php
<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    $admin = Role::firstOrCreate(['name' => 'admin']);
    $staff = Role::firstOrCreate(['name' => 'staff']);

    $this->admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ])->assignRole('admin');

    $this->staff = User::create([
        'name' => 'Staff',
        'email' => 'staff@test.com',
        'password' => bcrypt('password'),
    ])->assignRole('staff');
});

it('allows admin to access users page', function () {
    actingAs($this->admin)
        ->get('/users')
        ->assertStatus(200);
});

it('denies staff from accessing users page', function () {
    actingAs($this->staff)
        ->get('/users')
        ->assertStatus(403);
});

it('admin can create user', function () {
    actingAs($this->admin)
        ->post('/users', [
            'name' => 'New User',
            'email' => 'new@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'roles' => ['staff'],
        ])
        ->assertStatus(200);

    $this->assertDatabaseHas('users', ['email' => 'new@test.com']);
});

it('admin can delete user', function () {
    $userToDelete = User::create([
        'name' => 'Delete Me',
        'email' => 'delete@test.com',
        'password' => bcrypt('password'),
    ]);

    actingAs($this->admin)
        ->delete("/users/{$userToDelete->id}")
        ->assertStatus(200);

    $this->assertDatabaseMissing('users', ['email' => 'delete@test.com']);
});
```

- [ ] **Step 2: Run tests**

```bash
php artisan test --filter=UserManagement
```

- [ ] **Step 3: Commit**

```bash
git add tests/Feature/UserManagementTest.php
git commit -m "test(rbac): add user management tests"
```

---

## Task 12: Final Integration & Push

- [ ] **Step 1: Clear cache**

```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
```

- [ ] **Step 2: Run full test suite**

```bash
php artisan test
```

- [ ] **Step 3: Push to remote**

```bash
git push origin feature/rbac-user-management
```

- [ ] **Step 4: Create PR/MR**

Create merge request from `feature/rbac-user-management` to `develop`.

---

## Summary

| Task | Description |
|------|-------------|
| 1 | Install spatie/laravel-permission and yajra/laravel-datatables |
| 2 | Create roles and permissions migrations |
| 3 | Update User model with HasRoles trait |
| 4 | Create PermissionSeeder and RoleSeeder |
| 5 | Create CheckRole and CheckPermission middleware |
| 6 | Update routes with permission middleware |
| 7 | Create UserController and UserDataTable |
| 8 | Create blade views for user management |
| 9 | Update settings page with users tab |
| 10 | Protect sidebar menu items with @can |
| 11 | Write and run tests |
| 12 | Final integration and push |
