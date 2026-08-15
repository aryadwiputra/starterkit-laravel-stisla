<div class="empty-state">
    <div class="empty-state__figure">
        @if($icon)
        {!! $icon !!}
        @else
        {!! defaultIcon() !!}
        @endif
    </div>
    @if($title || $description)
    <div class="empty-state__body">
        @if($title)
        <h3 class="empty-state__title">{{ $title }}</h3>
        @endif
        @if($description)
        <p class="empty-state__description">{{ $description }}</p>
        @endif
        @if($slot->isNotEmpty())
        <div class="empty-state__action">
            {{ $slot }}
        </div>
        @endif
    </div>
    @endif
</div>
