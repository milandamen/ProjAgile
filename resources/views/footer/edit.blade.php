@extends('app')

@section('content')
<div class="container">
    <div class="row">
        {!! Breadcrumbs::render('editfooter') !!}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1>Wijzig Footer</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => 'footer.postEdit', 'method' => 'POST']) !!}
                <hr/>
                <input id="newOnSiteCheck" type="hidden" name="toNewOnSite" value="FALSE">
                <input id="newOnSiteMessage" type="hidden" name="newOnSiteMessage" value="">

                @for($c = 0; $c < count($footer); $c++)
                <div class="col-md-4">
                    <h2>Kolom {{$c + 1}}</h2>
                    {!! Form::textarea('column[]', $footer[$c]->text, ['placeholder' => 'Tekst', 'class' => 'form-control summernote']) !!}
                </div>
                @endfor

                <div id="success" class="col-lg-12">
                    <br/>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{route('admin.index', '')}}'">Annuleren</button>
                    <button type="submit" class="btn btn-success" onclick="validate()">Opslaan</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
    {!! HTML::script('summernote/js/summernote.js') !!}
    {!! HTML::script('custom/js/summernoteFunctions.js') !!}

    {!! HTML::script('custom/js/validateNewOnSite.js') !!}
@endsection


