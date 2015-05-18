@extends('app')

@section('content')

    <div class="container">
            {!! Breadcrumbs::render('user.editProfile') !!}
        <div class="row">

        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profiel wijzigen</h1>
            </div>
        </div>

        <div class="col-lg-12">
            @include('errors.partials._list')
            {!! Form::model($user, ['url' => route('user.updateProfile'), 'method' => 'PATCH']) !!}

            {!! Form::hidden('userId', $user->userId) !!}
            {!! Form::hidden('username', $user->username) !!}
            {!! Form::hidden('userGroupId', $user->userGroupId) !!}

            <div class="col-lg-5">
                <div class="form-group">
                    {!! Form::label('firstName', 'Voornaam') !!}
                    {!! Form::text('firstName', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('surname', 'Achternaam') !!}
                    {!! Form::text('surname', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group">
                    {!! HTML::decode(Form::label('password', 'Wachtwoord <small><t>*alleen invullen als u het wachtwoord wilt wijzigen</small>')) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Herhaal Wachtwoord') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('postal', 'Postcode') !!}
                    {!! Form::text('postal', $postal, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('houseNumber', 'Huisnummer') !!}
                    {!! Form::text('houseNumber', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <a href="{{route('user.showProfile')}}" class="btn btn-danger">Annuleer</a>
                    {!! Form::submit('Profiel Wijzigen', ['class' => 'btn btn-success']) !!}
                </div>
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@stop