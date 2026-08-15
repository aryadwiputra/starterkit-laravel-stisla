@if($href)
<a href="{{ $href }}" class="{{ $classes() }}">
    {{ $slot }}
</a>
@else
<button type="button" class="{{ $classes() }}">
    {{ $slot }}
</button>
@endif
