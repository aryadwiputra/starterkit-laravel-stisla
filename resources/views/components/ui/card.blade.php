<div class="card @if($flush) card--flush @endif">
    @if($title || $slot->has('actions'))
    <div class="card__header">
        @if($title)
        <h3 class="card__title">{{ $title }}</h3>
        @endif
        @if($slot->has('actions'))
        <div class="card__action">
            {{ $slot->get('actions') }}
        </div>
        @endif
    </div>
    @endif
    <div class="card__body">
        {{ $slot }}
    </div>
</div>
