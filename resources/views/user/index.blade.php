@extends('app')

@section('content')

    <div class="container">

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

        <!-- Administrator Table -->
        <div class="row">
            <div class="col-md-10">
                {!! link_to_route('user.create', 'Nieuwe Gebruiker', [], array('class' => 'btn btn-success white')) !!}
                <div class="col-md-12 addmargin">
                    <h3> Administrators </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th> Id </th>
                            <th> Gebruikersnaam </th>
                            <th> Voornaam </th>
                            <th> Achternaam </th>
                            <th> Email </th>
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
                                <td> <a href="{{ route('user.edit', [$admin->userId]) }}"> <span class="fa fa-pencil-square-o" aria-hidden="true"></span></a></td>
                                <td> <a href="{{ route('user.edit', [$admin->userId]) }}"> <span class="btn btn-danger btn-xs" aria-hidden="true">X</span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Content Manager Table -->
        <div class="row">
            <div class="col-md-10">
                <div class="col-md-12 addmargin">
                    <h3> Contentbeheerders </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th> Id </th>
                            <th> Gebruikersnaam </th>
                            <th> Voornaam </th>
                            <th> Achternaam </th>
                            <th> Email </th>
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
                                <td> <a href="{{ route('user.edit', [$contentmanager->userId]) }}"> <span class="fa fa-pencil-square-o" aria-hidden="true"></span></a></td>
                                <td> <a href="{{ route('user.edit', [$contentmanager->userId]) }}"> <span class="btn btn-danger btn-xs" aria-hidden="true">X</span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Resident Table -->
        <div class="row">
            <div class="col-md-10">
                <div class="col-md-12 addmargin">
                    <h3> Bewoners </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th> Id </th>
                            <th> Gebruikersnaam </th>
                            <th> Voornaam </th>
                            <th> Achternaam </th>
                            <th> Email </th>
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
                                <td> <a href="{{ route('user.edit', [$resident->userId]) }}"> <span class="fa fa-pencil-square-o" aria-hidden="true"></span></a></td>
                                <td> <a href="{{ route('user.edit', [$resident->userId]) }}"> <span class="btn btn-danger btn-xs" aria-hidden="true">X</span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@stop