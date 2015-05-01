@extends('app')

@section('content')
    <div class="container">
        <!-- Features Section -->

            <div class="col-lg-12">
                <h2 class="page-header">Menu Beheer</h2>
                {!! Form::open (['id' => 'menuForm','method' => 'PATCH']) !!}
                <ul class='space first-space' id='fullMenuList'>
                    @foreach($allMenuItems as $subMenu)
                        <li class='route'>
                            {!! Form::hidden($subMenu['main']->menuId, $subMenu['main']->menuOrder, ['class' => 'menuGroupItem' ]) !!}
                            <h3 class='title'>{!! $subMenu['main']->name !!}</h3>
                            <span class='ui-icon ui-icon-arrow-4-diag'></span>
                            <ul class='space'>
                                @if(isset($subMenu['sub']))
                                    @include('menu.partials._subMenuItem', ['items' => $subMenu['sub'],'main' =>$subMenu])
                                @endif
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>

        <div class="row"></div>

        <a class="btn btn-default pull-right" onclick="submitForm()"> Opslaan </a>
        {!! Form::close() !!}
    </div>


@stop

@section('additional_scripts')
    <!-- JavaScript that enables adding and removing rows -->
    {!! HTML::script('custom/js/menu_crud/responder.js') !!}
    {!! HTML::script('custom/js/menu_crud/menu_order.js') !!}
@endsection