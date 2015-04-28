@foreach ($items as $item)
    <li class='route'>
        {!! Form::text($item['main']->menuId, $item['main']->menuOrder . '.' . $main['main']->menuId, ['class' => 'menuGroupItem'] ) !!}
        <h3 class='title'>{!! $item['main']->name !!}</h3>
        <span class='ui-icon ui-icon-arrow-4-diag'></span>
        <ul class='space'>
        @if(isset($item['sub']))
            @include('menu.partials._subMenuItem', ['items' => $item['sub'], 'main' => $item])
        @endif
        </ul>
    </li>
@endforeach