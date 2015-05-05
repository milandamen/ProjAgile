@foreach ($items as $item)
    <li class='route'>
        <h3 class='title'>
            <i class="fa fa-arrows">&nbsp;&nbsp;&nbsp;</i>
            {!! $item['main']->name !!}
            <div class="pull-right">
                @if ($item['main']->publish == 0)
                    <i class="fa fa-eye-slash"></i>
                @else
                    <i class="fa fa-eye"></i>
                @endif
                <i class="fa fa-pencil-square-o"></i>
                <i class="fa fa-times"></i>
            </div>
        </h3>
        {!! Form::hidden($item['main']->menuId, $item['main']->menuOrder, ['class' => 'menuGroupItem'] ) !!}

        <ul class='space'>
        @if(isset($item['sub']))
            @include('menu.partials._subMenuItem', ['items' => $item['sub'], 'main' => $item])
        @endif
        </ul>
    </li>
@endforeach