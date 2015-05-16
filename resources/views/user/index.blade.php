@extends('app')

@section('content')
    <meta name="csrf-token" content="{{ Session::token() }}">
    <div class="container">

        <!-- breadcrumbs -->
        <div class="row">
                {!! Breadcrumbs::render('user') !!}
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">
                    Gebruikers
                </h2>
            </div>
        </div>

        <!-- search -->
        <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => route('user.index'), 'method' => 'POST', 'class' => 'navbar-form navbar-right']) !!}
            <div class="form-group">
            {!! Form::text('search', null, ['id' => 'search', 'class' => 'form-control', 'placeholder' => 'filter', 'autocomplete' => 'off']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        </div>


        <!-- Administrator Table -->
        <div class="row">
            <div class="col-md-12">
                {!! link_to_route('user.create', 'Nieuwe Gebruiker', [], array('class' => 'btn btn-success white')) !!}
                <div class="col-md-12 addmargin">
                    <h3> Administrators </h3>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Id </th>
                                <th> Gebruikersnaam </th>
                                <th> Voornaam </th>
                                <th> Achternaam </th>
                                <th> Email </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($admins as $admin)
                                <tr class="normalRow">
                                    <td> {!! $admin->userId !!} </td>
                                    <td> {!! $admin->username !!} </td>
                                    <td> {!! $admin->firstName !!} </td>
                                    <td> {!! $admin->surname !!} </td>
                                    <td> {!! $admin->email !!} </td>
                                    <td>
                                        <a href="{{ route('user.show', [$admin->userId]) }}">
                                            <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="right" href="{{ route('user.edit', [$admin->userId]) }}">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if($admin->active == 1)
                                            <a href="{{ route('user.deactivate', [$admin->userId]) }}" class="black deactivate">
                                                <i class="fa fa-lock fa-lg"></i>
                                            </a>
                                        @elseif($admin->active == 0)
                                            <a href="{{ route('user.activate', [$admin->userId]) }}" class="text-success activate">
                                                <i class="fa fa-unlock-alt fa-lg"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Manager Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 addmargin">
                    <h3> Contentbeheerders </h3>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Id </th>
                                <th class="username"> Gebruikersnaam </th>
                                <th> Voornaam </th>
                                <th> Achternaam </th>
                                <th> Email </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($contentmanagers as $contentmanager)
                                <tr class="normalRow">
                                    <td> {!! $contentmanager->userId !!} </td>
                                    <td> {!! $contentmanager->username !!} </td>
                                    <td> {!! $contentmanager->firstName !!} </td>
                                    <td> {!! $contentmanager->surname !!} </td>
                                    <td> {!! $contentmanager->email !!} </td>
                                    <td>
                                        <a href="{{ route('user.show', [$contentmanager->userId]) }}">
                                            <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="right" href="{{ route('user.edit', [$contentmanager->userId]) }}">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if($contentmanager->active == 1)
                                            <a href="{{ route('user.deactivate', [$contentmanager->userId]) }}" class="black deactivate">
                                                <i class="fa fa-lock fa-lg"></i>
                                            </a>
                                        @elseif($contentmanager->active == 0)
                                            <a href="{{ route('user.activate', [$contentmanager->userId]) }}" class="text-success activate">
                                                <i class="fa fa-unlock-alt fa-lg"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resident Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 addmargin">
                    <h3> Bewoners </h3>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Id </th>
                                <th> Gebruikersnaam </th>
                                <th> Voornaam </th>
                                <th> Achternaam </th>
                                <th> Email </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($residents as $resident)
                                <tr class="normalRow">
                                    <td> {!! $resident->userId !!} </td>
                                    <td> {!! $resident->username !!} </td>
                                    <td> {!! $resident->firstName !!} </td>
                                    <td> {!! $resident->surname !!} </td>
                                    <td> {!! $resident->email !!} </td>
                                    <td>
                                        <a href="{{ route('user.show', [$resident->userId]) }}">
                                            <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="right" href="{{ route('user.edit', [$resident->userId]) }}">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if($resident->active === 1)
                                            <a href="{{ route('user.deactivate', [$resident->userId]) }}" class="black deactivate">
                                                <i class="fa fa-lock fa-lg"></i>
                                            </a>
                                        @elseif($resident->active === 0)
                                            <a href="{{ route('user.activate', [$resident->userId]) }}" class="text-success activate">
                                                <i class="fa fa-unlock-alt fa-lg"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('additional_scripts')
    {!! HTML::script('custom/js/filterUserTables.js') !!}
@endsection