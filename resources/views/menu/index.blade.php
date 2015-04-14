@extends('app')

@section('content')
    <div class="container">
        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Menu Beheer</h2>

                <table class="table table-striped table-bordered">
                    <tbody>
                        @foreach($allMenuItems as $subMenu)
                            @if(isset($subMenu['sub']))
                                @include('menu.partials._subMenuItem', ['items' => $subMenu['sub'],'main' =>$subMenu])
                            @else
                                <tr>
                                    <td>{!! $subMenu['main']->name !!}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop