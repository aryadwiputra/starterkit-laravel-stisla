<div class="{{ $inputGroupClass() }}">
    @if($icon && $iconPosition === 'start')
    <span class="input-group__text">
        {!! $icon !!}
    </span>
    @endif
    {{ $slot }}
    @if($icon && $iconPosition === 'end')
    <span class="input-group__text">
        {!! $icon !!}
    </span>
    @endif
</div>
@if($label)
<label class="field__label">{{ $label }}</label>
@endif
