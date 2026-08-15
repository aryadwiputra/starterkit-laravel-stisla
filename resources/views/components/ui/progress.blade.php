<div class="progress">
    <div class="progress__track">
        <div
            class="{{ $barClass() }}"
            style="width: {{ $percentage() }}%"
            role="progressbar"
            aria-valuenow="{{ $value }}"
            aria-valuemin="0"
            aria-valuemax="{{ $max }}"
        ></div>
    </div>
    @if($slot->isNotEmpty())
    <div class="progress__label">
        {{ $slot }}
    </div>
    @endif
</div>
