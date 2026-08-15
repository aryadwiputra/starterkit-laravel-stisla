<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'orders.view',
            'orders.create',
            'orders.update',
            'orders.delete',
            'products.view',
            'products.create',
            'products.update',
            'products.delete',
            'customers.view',
            'customers.create',
            'customers.edit',
            'customers.delete',
            'reports.view',
            'profile.view',
            'profile.edit',
            'settings.view',
            'settings.edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
