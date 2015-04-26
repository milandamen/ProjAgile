@extends('app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">
                    @if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')
                        <a href="{{ route('news.manage')}}"><i class="fa fa-pencil-square-o"></i></a>
                    @endif
                    Gebruikers
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">

                <div class="col-md-12 addmargin">
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
                        @foreach($users as $user)
                            <tr>
                                <td> {!! $user->userId !!} </td>
                                <td> {!! $user->username !!} </td>
                                <td> {!! $user->firstName !!} </td>
                                <td> {!! $user->surname !!} </td>
                                <td> {!! $user->email !!} </td>
                                <td> <a href="{{ route('user.edit', [$user->userId]) }}"> <span class="fa fa-pencil-square-o" aria-hidden="true"></span></a></td>
                                <td> <a href="{{ route('user.edit', [$user->userId]) }}"> <span class="btn btn-danger btn-xs" aria-hidden="true">X</span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@stop