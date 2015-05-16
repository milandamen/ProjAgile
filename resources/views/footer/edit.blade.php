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
            <!---1, because id 4 is for the color-->
            @for($c = 0; $c < count($footer) - 1; $c++)
            <div class="col-md-4">
                <h2>Kolom {{$c + 1}}</h2>
                {!! Form::textarea('column[]', $footer[$c]->text, ['placeholder' => 'Tekst', 'class' => 'form-control summernote']) !!}
            </div>
            @endfor

            <div class="row">
                <div class="form-group col-sm-4">
                    <br/>
                    <label class="control-label col-sm-2">Kleur:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="footerColor" placeholder="#FFF">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12" id="newOnSiteGroup">
                    <label>Tonen op nieuw op de site?</label><br/>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" class="newOnSite" name="newOnSite" value="true">Ja
                        </label>
                        <label class="btn btn-default active">
                            <input type="radio" class="newOnSite" name="newOnSite" value="false" checked="true">Nee
                        </label>
                    </div>
                </div>
            </div>

            <div id="success" class="col-lg-12">
                <br/>
                <button type="button" class="btn btn-danger" onclick="location.href='{{route('admin.index', '')}}'">Annuleren</button>
                <button type="submit" class="btn btn-success">Opslaan</button>
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


