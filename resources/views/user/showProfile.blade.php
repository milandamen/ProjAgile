@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('user.showProfile') !!}
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">
                    <a href="{{ route('user.editProfile') }}"><i class="fa fa-pencil-square-o"></i></a>
                    Mijn profiel
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-1 addmargin">
                <h2>{{$user->username}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <table class="table credentials-table">
                    <tr><td class="table-left">Voornaam:</td><td>{{$user->firstName}}</td></tr>
                    <tr><td class="table-left">Achternaam:</td><td>{{$user->surname}}</td></tr>
                    <tr><td class="table-left">Email:</td><td>{{$user->email}}</td></tr>
                    <tr><td class="table-left">Postcode:</td><td>
                    @if (isset($postal))
                        {{$postal}}
                    @endif
                    </td></tr>
                    <tr><td class="table-left">Huisnummer:</td><td>{{$user->houseNumber}}</td></tr>
                    <tr><td class="table-left">Deelwijk:</td><td>
                        @if (isset($user->districtSectionId))
                            {{$user->districtsection->name}}
                        @endif
                    </td></tr>
                    <tr><td class="table-left">Gebruikersgroep:</td><td>{{$user->usergroup->name}}</td></tr>
                </table>
            </div>
        </div>
    </div>
@endsection