<div class="{{ $toastClass() }}" role="alert">
    <div class="toast__icon">
        @include('components.ui.toast-icons.'.$icon())
    </div>
    <div class="toast__content">
        @if($title)
        <div class="toast__title">{{ $title }}</div>
        @endif
        @if($message)
        <div class="toast__body">{{ $message }}</div>
        @else
        <div class="toast__body">{{ $slot }}</div>
        @endif
    </div>
    @if($dismissible)
    <button type="button" class="toast__close" data-stisla-toast-dismiss aria-label="Dismiss">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
    </button>
    @endif
</div>
