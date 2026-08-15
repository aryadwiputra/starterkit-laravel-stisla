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
