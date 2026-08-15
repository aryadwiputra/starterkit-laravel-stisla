<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $inputId() }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
    @if($disabled) disabled @endif
    @if($error) aria-invalid="true" @endif
    class="input @if($error) input--error @endif"
    {{ $attributes->class(['input--error' => $error]) }}
/>
@if($error)
<p class="field__meta text-danger">{{ $error }}</p>
@elseif($help)
<p class="field__meta">{{ $help }}</p>
@endif
