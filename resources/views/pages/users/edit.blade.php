<div class="dialog" id="editUserModal" data-stisla-dialog aria-hidden="true">
    <div class="dialog__backdrop" data-stisla-dialog-close></div>
    <div class="dialog__panel dialog__panel--sm" role="dialog" aria-modal="true" aria-labelledby="editUserModalTitle">
        <div class="dialog__header">
            <h2 class="dialog__title" id="editUserModalTitle">Edit User</h2>
            <button type="button" class="button button--ghost button--neutral button--icon-only" data-stisla-dialog-close aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="none" stroke="currentColor" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="editUserForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-id" name="id">
            <div class="dialog__body flex flex-col gap-4">
                <div class="field">
                    <label for="edit-name" class="field__label">Name</label>
                    <input type="text" class="input" id="edit-name" name="name" required>
                </div>
                <div class="field">
                    <label for="edit-email" class="field__label">Email</label>
                    <input type="email" class="input" id="edit-email" name="email" required>
                </div>
                <div class="field">
                    <label for="edit-password" class="field__label">Password (leave blank to keep current)</label>
                    <input type="password" class="input" id="edit-password" name="password">
                </div>
                <div class="field">
                    <label for="edit-roles" class="field__label">Roles</label>
                    <select class="input" id="edit-roles" name="roles[]" multiple required>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
            </div>
            <div class="dialog__footer">
                <button type="button" class="button button--outline button--neutral" data-stisla-dialog-close>Cancel</button>
                <button type="submit" class="button button--primary">Update User</button>
            </div>
        </form>
    </div>
</div>
