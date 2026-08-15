<select
    name="{{ $name }}"
    id="{{ $inputId() }}"
    @if($required) required @endif
    @if($disabled) disabled @endif
    class="input @if($error) input--error @endif"
>
    @if($placeholder)
    <option value="" disabled @if(!$value) selected @endif>{{ $placeholder }}</option>
    @endif
    @foreach($options as $optionValue => $optionLabel)
    <option value="{{ $optionValue }}" @if($isSelected($optionValue)) selected @endif>{{ $optionLabel }}</option>
    @endforeach
</select>
@if($error)
<p class="field__meta text-danger">{{ $error }}</p>
@endif
