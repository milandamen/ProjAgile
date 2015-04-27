@extends('app')

@section('content')

    <div class="container">

        <div class="row">
            {!! Breadcrumbs::render('adduser') !!}
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gebruiker aanmaken</h1>
            </div>
        </div>

        <div class="col-lg-12">

            {!! Form::model($user, ['url' => route('user.store'), 'method' => 'PUT']) !!}


            <div class="form-group">
                {!! Form::label('username', 'Gebruikersnaam') !!}
                {!! Form::text('username', null, ['class' => 'form-control']) !!}
            </div>

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

            <div class="form-group">
                {!! Form::label('password', 'Wachtwoord') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Gebruiker Aanmaken', ['class' => 'btn btn-default']) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@stop