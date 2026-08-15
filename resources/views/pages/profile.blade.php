@extends('layouts.app')

@section('content')
<header class="page__header">
  <h1 class="page__title">Profile</h1>
</header>

<div class="page__body">
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 xl:col-span-4">
      <div class="card">
        <div class="card__body text-center">
          <div class="mb-4">
            <span class="avatar avatar--xl avatar--circle">
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
            </span>
          </div>
          <h3 class="text-lg font-medium">Steven Gerrard</h3>
          <p class="text-muted-foreground">Admin</p>
          <div class="flex justify-center gap-2 mt-4">
            <button class="button button--outline button--neutral">Change Photo</button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-span-12 xl:col-span-8">
      <div class="card">
        <div class="card__header">
          <h3 class="card__title">Personal Information</h3>
        </div>
        <div class="card__body">
          <form class="flex flex-col gap-4">
            <div class="grid grid-cols-2 gap-4">
              <div class="field">
                <label for="first_name" class="field__label">First Name</label>
                <input type="text" class="input" id="first_name" name="first_name" value="Steven"/>
              </div>
              <div class="field">
                <label for="last_name" class="field__label">Last Name</label>
                <input type="text" class="input" id="last_name" name="last_name" value="Gerrard"/>
              </div>
            </div>
            <div class="field">
              <label for="email" class="field__label">Email</label>
              <input type="email" class="input" id="email" name="email" value="steven@meridian.com"/>
            </div>
            <div class="field">
              <label for="phone" class="field__label">Phone</label>
              <input type="tel" class="input" id="phone" name="phone" value="+1 (555) 123-4567"/>
            </div>
            <div class="flex gap-2">
              <button type="submit" class="button button--primary">Save Changes</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card__header">
          <h3 class="card__title">Change Password</h3>
        </div>
        <div class="card__body">
          <form class="flex flex-col gap-4">
            <div class="field">
              <label for="current_password" class="field__label">Current Password</label>
              <input type="password" class="input" id="current_password" name="current_password"/>
            </div>
            <div class="field">
              <label for="new_password" class="field__label">New Password</label>
              <input type="password" class="input" id="new_password" name="new_password"/>
            </div>
            <div class="field">
              <label for="confirm_password" class="field__label">Confirm New Password</label>
              <input type="password" class="input" id="confirm_password" name="confirm_password"/>
            </div>
            <div class="flex gap-2">
              <button type="submit" class="button button--primary">Update Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
