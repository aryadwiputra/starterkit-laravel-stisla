# RBAC + User Management + DataTable Spec

**Date:** 2026-08-15
**Project:** starterkit-laravel-stisla

---

## Overview

Implementasi Role-Based Access Control (RBAC) menggunakan Spatie Permission dengan DataTable untuk user management. Fitur ini terintegrasi dengan existing settings page.

## Stack

- **RBAC:** spatie/laravel-permission
- **DataTable:** yajra/laravel-datatables-oracle
- **Auth:** Laravel Fortify (existing)

## Package Installation

```bash
composer require spatie/laravel-permission yajra/laravel-datatables-oracle
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"
```

## Database Structure

### Tables
- `roles` (id, name, guard_name, timestamps)
- `permissions` (id, name, guard_name, timestamps)
- `role_has_permissions` (pivot)
- `model_has_roles` (pivot - replaces existing user role)
- `model_has_permissions` (pivot)

### Migrations
1. Create roles table
2. Create permissions table
3. Create pivot tables
4. Remove existing two_factor_columns migration (cleanup)

## Permissions Structure

```
users: users.view, users.create, users.edit, users.delete
orders: orders.view, orders.create, orders.update, orders.delete
products: products.view, products.create, products.update, products.delete
customers: customers.view, customers.create, customers.edit, customers.delete
reports: reports.view
profile: profile.view, profile.edit
settings: settings.view, settings.edit
```

## Default Roles

| Role | Permissions |
|------|------------|
| Admin | Semua permissions |
| Staff | orders.view, orders.create, orders.update, products.view, customers.view, reports.view, profile.view, profile.edit |

## Seeder

Create `RoleSeeder` and `PermissionSeeder`:
1. Create permissions based on structure above
2. Create Admin role with all permissions
3. Create Staff role with limited permissions

## User Model

Add Spatie traits:
```php
use HasRoles;

protected $fillable = ['name', 'email', 'password'];
```

## Middleware

### Gate/AuthServiceProvider
Register permissions at boot:
```php
Permission::getPermissions()->map(function ($permission) {
    Gate::define($permission->name, fn($user) => $user->hasPermissionTo($permission));
});
```

### Custom Middleware (optional)
Create `role` and `permission` middleware for route protection.

## Route Protection

Protect existing routes:
```php
Route::middleware(['auth', 'permission:orders.view'])->group(function () {
    Route::get('/orders', ...)->name('orders.index');
});
```

## UI Integration

### Settings Page
Settings page becomes tabbed:
- General
- Users (with DataTable) - only visible to Admin
- Appearance
- Notifications

### User Management DataTable
Columns:
- Checkbox (bulk select)
- Name
- Email
- Roles (badges)
- Created At
- Actions (Edit, Delete)

Actions:
- Create User (modal or page)
- Edit User (modal or page with role assignment)
- Delete User (with confirmation)
- Bulk Delete

### Blade Integration
Use `@can`, `@cannot`, `@role` directives:
```blade
@can('users.view')
    <a href="{{ route('settings', '#users') }}">Users</a>
@endcan

@role('admin')
    <li>Admin Menu</li>
@endrole
```

### Unauthorized Access
- Redirect to dashboard with toast error
- Or return 403 error page

## File Structure

```
app/
├── Models/
│   └── User.php (add HasRoles trait)
├── Http/
│   ├── Controllers/
│   │   └── UserController.php (DataTable controller)
│   └── Middleware/
│       └── RoleMiddleware.php
├── Providers/
│   └── AuthServiceProvider.php (register permissions)
config/
├── permission.php (from spatie)
database/
├── migrations/
│   └── create_roles_and_permissions_tables.php
├── seeders/
│   ├── DatabaseSeeder.php (call RoleSeeder)
│   ├── RoleSeeder.php
│   └── PermissionSeeder.php
resources/views/
├── pages/
│   ├── settings.blade.php (add Users tab)
│   └── users/
│       ├── index.blade.php (DataTable container)
│       ├── create.blade.php (modal)
│       └── edit.blade.php (modal)
routes/
└── web.php (add permission middleware)
```

## Implementation Order

1. Install packages
2. Publish configs
3. Create migrations
4. Update User model
5. Create seeders
6. Register permissions in AuthServiceProvider
7. Create middleware
8. Update routes with middleware
9. Create UserController for DataTable
10. Create blade views (settings tab, user modals)
11. Update sidebar with @can directives
12. Write tests

## Testing

- Feature test: User with role can access protected routes
- Feature test: User without role cannot access protected routes
- Feature test: DataTable renders with proper data
- Feature test: CRUD operations on users

## Git Flow

Feature branch: `feature/rbac-user-management`
