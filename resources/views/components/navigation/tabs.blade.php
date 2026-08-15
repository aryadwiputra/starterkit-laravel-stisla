<div class="{{ $tabsClass() }}" data-stisla-tabs>
    <div class="tabs__list" role="tablist">
        {{ $slot }}
    </div>
    {{ $slot->get('panels') }}
</div>
