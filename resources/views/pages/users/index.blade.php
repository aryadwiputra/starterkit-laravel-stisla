@extends('layouts.app')

@section('content')
<div class="page__header">
    <h1 class="page__title">Users</h1>
</div>

<div class="page__body">
    <div class="card">
        <div class="card__header">
            <h3 class="card__title">User Management</h3>
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
</div>

@include('pages.users.create')
@include('pages.users.edit')
@endsection

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
                $('#editUserModal').classList.add('is-open');
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
                    $('#editUserModal').classList.remove('is-open');
                    window.usersTable.ajax.reload();
                }
            });
        });
    }
})();
</script>
@endpush
