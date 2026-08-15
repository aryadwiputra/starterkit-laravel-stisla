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
            <div class="field">
              <label for="currency" class="field__label">Currency</label>
              <select class="input" id="currency" name="currency">
                <option value="USD" selected>USD - US Dollar</option>
                <option value="EUR">EUR - Euro</option>
                <option value="GBP">GBP - British Pound</option>
              </select>
            </div>
            <button type="submit" class="button button--primary self-start">Save Changes</button>
          </form>
        </div>
      </div>

      @can('users.view')
      <div class="card mt-4" id="users">
        <div class="card__body p-0">
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
          />
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
            <div class="field__item">
              <input type="checkbox" id="low_stock_alerts" checked/>
              <label for="low_stock_alerts">Low stock alerts</label>
            </div>
          </div>
          <button type="submit" class="button button--primary mt-4">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
</div>

@can('users.view')
@include('pages.users.create')
@include('pages.users.edit')
@endcan
@endsection
