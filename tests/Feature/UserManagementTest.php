<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $staff;

    protected function setUp(): void
    {
        parent::setUp();

        $permissions = [
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'orders.view', 'orders.create', 'orders.update', 'orders.delete',
            'products.view', 'products.create', 'products.update', 'products.delete',
            'customers.view', 'customers.create', 'customers.edit', 'customers.delete',
            'reports.view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        $staffRole = Role::create(['name' => 'staff', 'guard_name' => 'web']);
        $staffRole->givePermissionTo('orders.view', 'orders.create', 'orders.update', 'products.view', 'customers.view', 'reports.view');

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
    }

    public function test_admin_can_access_orders_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/orders');

        $response->assertStatus(200);
    }

    public function test_staff_can_access_orders_page(): void
    {
        $response = $this->actingAs($this->staff)->get('/orders');

        $response->assertStatus(200);
    }

    public function test_staff_cannot_access_users_page(): void
    {
        $response = $this->actingAs($this->staff)->get('/users');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_users_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/users');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_user(): void
    {
        $response = $this->actingAs($this->admin)->post('/users', [
            'name' => 'New User',
            'email' => 'new@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'roles' => ['staff'],
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'new@test.com']);
    }

    public function test_admin_can_delete_user(): void
    {
        $userToDelete = User::create([
            'name' => 'Delete Me',
            'email' => 'delete@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($this->admin)->delete("/users/{$userToDelete->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['email' => 'delete@test.com']);
    }
}
