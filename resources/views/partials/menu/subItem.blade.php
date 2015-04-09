<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{!! $main['main']->name !!} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">

        @foreach ($items as $item)
                    <li><a href="{!! $item['main']->relativeUrl !!}">{!! $item['main']->name !!}</a></li>
                @if(isset($item['sub']))
                    @include('partials.menu.', ['items' => $item['sub']])
                @endif
        @endforeach
</ul>