<span class="{{ $avatarClass() }}" data-stisla-avatar>
    @if($src)
    <img class="avatar__image" src="{{ $src }}" alt="{{ $name }}"/>
    @endif
    <span class="avatar__fallback">{{ $fallback() }}</span>
</span>
