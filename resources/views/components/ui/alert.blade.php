<div class="{{ $alertClass() }}" role="alert">
    <div class="alert__body">
        @if($title)
        <div class="alert__title">{{ $title }}</div>
        @endif
        @if($message)
        <div class="alert__description">{{ $message }}</div>
        @else
        {{ $slot }}
        @endif
    </div>
    @if($dismissible)
    <button type="button" class="alert__close" aria-label="Dismiss">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    @endif
</div>
