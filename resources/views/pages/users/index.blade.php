@extends('layouts.app')

@section('content')
<div class="page__header">
    <h1 class="page__title">Users</h1>
</div>

<div class="page__body">
    <x-stisla-table
        :data-route="route('users.data')"
        :columns="[
            ['label' => '#', 'name' => 'id'],
            ['label' => 'Name', 'name' => 'name'],
            ['label' => 'Email', 'name' => 'email'],
            ['label' => 'Roles', 'name' => 'roles', 'sortable' => false],
            ['label' => 'Created', 'name' => 'created_at'],
            ['label' => 'Actions', 'name' => 'actions', 'sortable' => false, 'class' => 'text-right'],
        ]"
        :striped="true"
        :hover="true"
        :checkbox="true"
        caption="User Management"
    >
        @can('users.create')
        <button type="button" class="button button--primary button--sm" onclick="document.getElementById('createUserModal').classList.add('is-open')">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                <path fill="none" stroke="currentColor" stroke-width="2" d="M12 5v14m-7-7h14"/>
            </svg>
            Add User
        </button>
        @endcan
    </x-stisla-table>
</div>

@include('pages.users.create')
@include('pages.users.edit')
@endsection
