@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('showuser', $user) !!}
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">
                    Mijn profiel
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-1 addmargin">
                <h1>{{$user->username}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <table class="table credentials-table">
                    <tr><td class="table-left">Gebruikersroep:</td><td>{{$user->usergroup->name}}</td></tr>
                    <tr><td class="table-left">Deelwijk:</td><td>
                            @if (isset($user->districtsection))
                                {{$user->districtsection->name}}
                            @endif
                        </td></tr>
                    <tr><td class="table-left">Voornaam:</td><td>{{$user->firstName}}</td></tr>
                    <tr><td class="table-left">Achternaam:</td><td>{{$user->surname}}</td></tr>
                    <tr><td class="table-left">Huisnummer:</td><td>{{$user->houseNumber}}</td></tr>
                    <tr><td class="table-left">Email:</td><td>{{$user->email}}</td></tr>
                    <tr><td class="table-left">Actief:</td><td>
                            @if($user->active === 0)
                                Nee
                            @else
                                Ja
                            @endif
                        </td></tr>
                </table>
            </div>
        </div>
    </div>
@endsection