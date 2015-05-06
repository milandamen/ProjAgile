@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('newMenuItem') !!}
        </div>
        <div class="col-lg-12">
            <h2 class="page-header">Menu Item Aanmaken</h2>
            @include('errors.partials._list')
            <div class="col-md-4 col-xs-offset-4">
            {!! Form::open (['id' => 'menuItemForm','method' => 'PUT']) !!}
            <p>{!! Form::text('name', old('Naam'), ['placeholder' => 'Naam', 'class' => 'form-control']) !!}</p>
            <p>{!! Form::text('link', old('Link'), ['placeholder' => 'Link', 'class' => 'form-control autocomplete']) !!}</p>
            <p>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" name="publish" value="true" checked=true>Ja
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="publish" value="false">Nee
                    </label>
                </div>
            </p>

            {!! Form::submit('Opslaan', ['class' => 'btn btn-default']) !!}

            {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        var autocompleteURL = "{!! route('autocomplete.autocomplete', '') !!}";
    </script>
@stop

@section('additional_scripts')
    {!! HTML::script('custom/js/autocomplete.js') !!}
@endsection