<label class="field__item">
    <input
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        @if($checked) checked @endif
        @if($disabled) disabled @endif
        class="checkbox"
    />
    @if($label)
    <span class="field__label">{{ $label }}</span>
    @endif
</label>
