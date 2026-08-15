<textarea
    name="{{ $name }}"
    id="{{ $inputId() }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
    @if($disabled) disabled @endif
    class="input @if($error) input--error @endif"
>{{ old($name, $value) }}</textarea>
@if($error)
<p class="field__meta text-danger">{{ $error }}</p>
@endif
