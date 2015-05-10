@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('editmenu') !!}
        </div>
            <div class="col-lg-12">
                <h2 class="page-header">Menu Wijzigen</h2>
                <a class="btn btn-success white pull-left" href="{{ route('menu.create') }}" role="button">Nieuw Menu Item Aanmaken </a>
                <br>
                <br>
                {!! Form::open (['id' => 'menuForm','method' => 'PATCH']) !!}
                <a class="btn btn-default pull-right" onclick="submitForm()">Menu Opslaan </a>
                <ul class='space first-space' id='fullMenuList'>
                    @foreach($allMenuItemsEdit as $subMenu)
                        <li class='route'>
                            <h3 class='title'>
                                <i class="fa fa-arrows">&nbsp;&nbsp;&nbsp;</i>
                                {!! $subMenu['main']->name !!}
                                <div class="pull-right">
                                    @if ($subMenu['main']->publish == 0)
                                        <i class="fa fa-eye-slash"></i>
                                    @else
                                        <i class="fa fa-eye"></i>
                                    @endif
                                    {!! link_to_route('menu.edit', '', [e($subMenu['main']->menuId)], ['class' => 'fa fa-pencil-square-o']) !!}
                                    <a onclick="removeItem(this)" href="javascript:void(0)"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </h3>

                            {!! Form::hidden($subMenu['main']->menuId, $subMenu['main']->menuOrder, ['class' => 'menuGroupItem' ]) !!}
                            <ul class='space'>
                                @if(isset($subMenu['sub']))
                                    @include('menu.partials._subMenuItem', ['items' => $subMenu['sub'],'main' =>$subMenu])
                                @endif
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>



        <a class="btn btn-default pull-right" onclick="submitForm()">Menu Opslaan </a>
        {!! Form::close() !!}
    </div>
@stop

@section('additional_scripts')
    <!-- JavaScript that enables adding and removing rows -->
    {!! HTML::script('custom/js/menu_crud/responder.js') !!}
    {!! HTML::script('custom/js/menu_crud/menu_order.js') !!}
@endsection