<div class="dialog" id="{{ $id }}" data-stisla-dialog aria-hidden="true">
    <div class="dialog__backdrop" data-stisla-dialog-close></div>
    <div class="dialog__panel {{ $dialogClass() }}" role="dialog" aria-modal="true" aria-labelledby="{{ $id }}-title">
        @if($title)
        <div class="dialog__header">
            <h2 class="dialog__title" id="{{ $id }}-title">{{ $title }}</h2>
            <button type="button" class="button button--ghost button--neutral button--icon-only" data-stisla-dialog-close aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @endif
        <div class="dialog__body">
            {{ $slot }}
        </div>
        @if($slot->has('footer'))
        <div class="dialog__footer">
            {{ $slot->get('footer') }}
        </div>
        @endif
    </div>
</div>
