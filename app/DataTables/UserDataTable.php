<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables as DataTablesFacade;

class UserDataTable
{
    public function handle()
    {
        $users = User::with('roles')->select('users.*');

        return DataTablesFacade::of($users)
            ->addColumn('roles', function ($user) {
                return $user->getRoleNames()->map(fn($role) => '<span class="badge badge--soft badge--primary">' . e($role) . '</span>')->implode(' ');
            })
            ->addColumn('action', function ($user) {
                $buttons = '';
                $auth = Auth::user();

                if ($auth && $auth->can('users.edit')) {
                    $buttons .= '<button type="button" class="button button--sm button--ghost button--neutral edit-user" data-id="' . $user->id . '">Edit</button> ';
                }

                if ($auth && $auth->can('users.delete') && $user->id !== $auth->id) {
                    $buttons .= '<button type="button" class="button button--sm button--ghost button--danger delete-user" data-id="' . $user->id . '">Delete</button>';
                }

                return $buttons;
            })
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }
}
