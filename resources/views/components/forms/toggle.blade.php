<label class="toggle">
    <input
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        @if($checked) checked @endif
        @if($disabled) disabled @endif
        class="toggle-input"
    />
    <span class="toggle__body">
        <span class="toggle__track">
            <span class="toggle__thumb"></span>
        </span>
    </span>
    @if($label)
    <span class="toggle__label">{{ $label }}</span>
    @endif
</label>
