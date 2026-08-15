<nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
        @foreach($items as $index => $item)
        <li class="breadcrumb__item @if($loop->last) active @endif">
            @if($loop->last || !isset($item['url']))
            {{ $item['label'] }}
            @else
            <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
            @endif
        </li>
        @endforeach
    </ol>
</nav>
