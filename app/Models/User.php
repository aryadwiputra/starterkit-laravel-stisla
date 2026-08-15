<?php

namespace App\Models;

use App\Traits\HasDataTable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasDataTable, HasFactory, HasRoles, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dataTableActions(): array
    {
        return [
            'edit' => [
                'label' => 'Edit',
                'url' => '/users/{id}/edit',
                'permission' => 'users.edit',
                'class' => 'button button--sm button--ghost button--neutral',
            ],
            'delete' => [
                'label' => 'Delete',
                'url' => '/users/{id}',
                'permission' => 'users.delete',
                'class' => 'button button--sm button--ghost button--danger',
                'confirm' => true,
            ],
        ];
    }
}
