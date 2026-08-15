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
        <div class="card__header">
          <h3 class="card__title">Users</h3>
          @can('users.create')
          <button type="button" class="button button--primary button--sm" onclick="document.getElementById('createUserModal').classList.add('is-open')">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
              <path fill="none" stroke="currentColor" stroke-width="2" d="M12 5v14m-7-7h14"/>
            </svg>
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

@can('users.view')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
(function() {
    if (document.getElementById('users-table')) {
        window.usersTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.index') }}?dt=1',
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
            $.get('/users/' + id + '/edit', function(data) {
                $('#edit-id').val(data.id);
                $('#edit-name').val(data.name);
                $('#edit-email').val(data.email);
                $('#edit-roles').val(data.roles).trigger('change');
                document.getElementById('editUserModal').classList.add('is-open');
            });
        });

        $(document).on('click', '.delete-user', function() {
            if (confirm('Are you sure you want to delete this user?')) {
                var id = $(this).data('id');
                $.ajax({
                    url: '/users/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function() {
                        window.usersTable.ajax.reload();
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
                    document.getElementById('editUserModal').classList.remove('is-open');
                    window.usersTable.ajax.reload();
                }
            });
        });
    }
})();
</script>
@endpush
@endcan
