@extends('app')

@section('content')
    <div class="container">

        <!-- breadcrumbs, show search criteria if given -->
        <div class="row">
            @if(isset($criteria))
                {!! Breadcrumbs::render('userfilter', (object)['criteria' => $criteria]) !!}
            @else
                {!! $criteria = null; !!}
                {!! Breadcrumbs::render('user') !!}
            @endif
        </div>

        <!-- notify if no search results are found -->
        @if (isset($count) && $count === 0)
            <div class="row">
                <h2>{!! "Helaas, er zijn geen zoekresultaten" !!}</h2>
            </div>
        @else

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
            {!! Form::text('search', null, ['id' => 'search', 'class' => 'form-control autocomplete', 'placeholder' => 'filter']) !!}
            </div>
            {!! Form::submit('Zoek', ['class' => 'btn btn-default']) !!}
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
                                <tr>
                                    <td> {!! $admin->userId !!} </td>
                                    <td> {!! $admin->username !!} </td>
                                    <td> {!! $admin->firstName !!} </td>
                                    <td> {!! $admin->surname !!} </td>
                                    <td> {!! $admin->email !!} </td>
                                    <td>
                                        <a href="{{ route('user.index', [$admin->userId]) }}">
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
                                            <a href="{{ route('user.deactivate', [$admin->userId, $criteria]) }}" class="black">
                                                <i class="fa fa-lock fa-lg"></i>
                                            </a>
                                        @elseif($admin->active == 0)
                                            <a href="{{ route('user.activate', [$admin->userId, $criteria]) }}" class="text-success">
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
                                <tr>
                                    <td> {!! $contentmanager->userId !!} </td>
                                    <td> {!! $contentmanager->username !!} </td>
                                    <td> {!! $contentmanager->firstName !!} </td>
                                    <td> {!! $contentmanager->surname !!} </td>
                                    <td> {!! $contentmanager->email !!} </td>
                                    <td>
                                        <a href="{{ route('user.index', [$contentmanager->userId]) }}">
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
                                            <a href="{{ route('user.deactivate', [$contentmanager->userId, $criteria]) }}" class="black">
                                                <i class="fa fa-lock fa-lg"></i>
                                            </a>
                                        @elseif($contentmanager->active == 0)
                                            <a href="{{ route('user.activate', [$contentmanager->userId, $criteria]) }}" class="text-success">
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
                                <tr>
                                    <td> {!! $resident->userId !!} </td>
                                    <td> {!! $resident->username !!} </td>
                                    <td> {!! $resident->firstName !!} </td>
                                    <td> {!! $resident->surname !!} </td>
                                    <td> {!! $resident->email !!} </td>
                                    <td>
                                        <a href="{{ route('user.index', [$resident->userId]) }}">
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
                                            <a href="{{ route('user.deactivate', [$resident->userId, $criteria]) }}" class="black">
                                                <i class="fa fa-lock fa-lg"></i>
                                            </a>
                                        @elseif($resident->active === 0)
                                            <a href="{{ route('user.activate', [$resident->userId, $criteria]) }}" class="text-success">
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
        @endif
    </div>
    <script>
        var autocompleteURL = "{!! route('autocomplete.userAutocomplete', '') !!}";
    </script>
@stop

@section('additional_scripts')
    {!! HTML::script('custom/js/autocomplete.js') !!}
    {!! HTML::script('custom/js/filterUserTables.js') !!}
@endsection