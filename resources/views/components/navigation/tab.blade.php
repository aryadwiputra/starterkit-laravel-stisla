<button
    type="button"
    role="tab"
    class="tabs__item @if($active) active @endif"
    data-stisla-tabs-value="{{ $value }}"
    @if($href) aria-controls="{{ $href }}" @endif
>
    {{ $label ?? $slot }}
</button>
