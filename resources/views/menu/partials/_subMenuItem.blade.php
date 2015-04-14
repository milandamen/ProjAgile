<tr>
    <td class="success">{!! $main['main']->name !!}</td>
</tr>
<tr>
        @foreach ($items as $item)

                @if(isset($item['sub']))
                    @include('menu.partials._subMenuItem', ['items' => $item['sub'],'main' => $item])
                @else
                    <td>{!! $item['main']->name !!}</td>
                @endif
        @endforeach
</tr>