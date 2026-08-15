<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('roles', function ($user) {
                return $user->getRoleNames()->map(fn($role) => '<span class="badge badge--soft badge--primary">' . e($role) . '</span>')->implode(' ');
            })
            ->addColumn('action', function ($user) {
                $buttons = '';

                if (Auth::user()->can('users.edit')) {
                    $buttons .= '<button type="button" class="button button--sm button--ghost button--neutral edit-user" data-id="' . $user->id . '">Edit</button> ';
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
            ->buttons([]);
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
