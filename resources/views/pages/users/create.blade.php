<div class="dialog" id="createUserModal" data-stisla-dialog aria-hidden="true">
    <div class="dialog__backdrop" data-stisla-dialog-close></div>
    <div class="dialog__panel dialog__panel--sm" role="dialog" aria-modal="true" aria-labelledby="createUserModalTitle">
        <div class="dialog__header">
            <h2 class="dialog__title" id="createUserModalTitle">Create User</h2>
            <button type="button" class="button button--ghost button--neutral button--icon-only" data-stisla-dialog-close aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="none" stroke="currentColor" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="createUserForm">
            @csrf
            <div class="dialog__body flex flex-col gap-4">
                <div class="field">
                    <label for="create-name" class="field__label">Name</label>
                    <input type="text" class="input" id="create-name" name="name" required>
                </div>
                <div class="field">
                    <label for="create-email" class="field__label">Email</label>
                    <input type="email" class="input" id="create-email" name="email" required>
                </div>
                <div class="field">
                    <label for="create-password" class="field__label">Password</label>
                    <input type="password" class="input" id="create-password" name="password" required>
                </div>
                <div class="field">
                    <label for="create-password_confirmation" class="field__label">Confirm Password</label>
                    <input type="password" class="input" id="create-password_confirmation" name="password_confirmation" required>
                </div>
                <div class="field">
                    <label for="create-roles" class="field__label">Roles</label>
                    <select class="input" id="create-roles" name="roles[]" multiple required>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
            </div>
            <div class="dialog__footer">
                <button type="button" class="button button--outline button--neutral" data-stisla-dialog-close>Cancel</button>
                <button type="submit" class="button button--primary">Create User</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function() {
    document.getElementById('createUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var form = e.target;
        var formData = new FormData(form);

        fetch('{{ route('users.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            document.getElementById('createUserModal').classList.remove('is-open');
            form.reset();
            if (window.usersTable) {
                window.usersTable.ajax.reload();
            }
        });
    });
})();
</script>
@endpush
