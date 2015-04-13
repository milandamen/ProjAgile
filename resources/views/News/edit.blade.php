@extends('App')

<link href="bootstrap.css" rel="stylesheet">
<link href="bootstrap-switch.css" rel="stylesheet">
<script src="jquery.js"></script>
<script src="bootstrap-switch.js"></script>
<script type="text/javascript">
    $('.switch').bootstrapSwitch();

    $('.datepicker').datepicker();
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
    });
</script>
<script src="/ProjAgile/public/js/newsValidate.js"></script>


@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Content Panel</a></li>
            <li class="active">Nieuws wijzigen</li>
        </ol>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nieuws wijzigen</h1>
            </div>
        </div>

        <div class="col-lg-12">
            {!! Form::model($newsItem, ['method' => 'PATCH', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', old($newsItem->title), ['placeholder' => 'Titel', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {!! Form::text('textarea', old($newsItem->content), ['placeholder' => 'Content', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('districtSection', 'Sectie') !!}
                    {!! Form::select('districtSectionId', ['0' => 'Home'] + $districtSections, old('districtSectionId'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('hide', 'Verbergen?') !!}<br/>
                    <div name="hide" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" name="hidden" value="true">Ja
                        </label>
                        <label class="btn btn-default active">
                            <input type="radio" name="hidden" value="false" checked="true">Nee
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('publishStartDate', 'Publish datum') !!}
                    {!! Form::text('publishStartDate', old($newsItem->publishStartDate), ['class' => 'form-control', 'data-datepicker' => 'datepicker', 'data-provide' => 'datepicker'], old('publishStartDate')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('publishEndDate', 'Einde publish') !!}
                    {!! Form::text('publishEndDate', old($newsItem->publishEndDate), ['class' => 'form-control', 'data-datepicker' => 'datepicker'], old('publishEndDate')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('onTop', 'Bovenaan de pagina?') !!}<br/>
                    <div name="onTop" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" name="top" value="true">Ja
                        </label>
                        <label class="btn btn-default active">
                            <input type="radio" name="top" value="false" checked="true">Nee
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fileUpload', 'Files toevoegen') !!}<br/>
                    <table name="fileUpload">
                    @foreach($files as $file)
                        {!!    '<tr><td style="padding-top:5px;">' . Form::text($file->fileId, $file->path, ['style' => 'width:500px;']) . '</td>' !!}

                            <td style="padding-top:5px;"><button id="{!! $file->fileId!!}" style="margin-left: 10px" type="button" class="btn btn-danger" aria-label="Left Align">
                                <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button></td></tr>
                    @endforeach
                        {!! '<tr><td style="padding-top:5px;">' . Form::file('Voeg een nieuwe file toe') . '</td>' !!}

                        <td style="padding-top:5px;"><button id="newFile" style="margin-left: 10px" type="button" class="btn btn-success" aria-label="Left Align">
                            <span class="glyphicon glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button></td>
                    </table>
                </div>
                <div class="form-group">
                    {!! Form::submit('opslaan', ['class' => 'btn btn-default']) !!} <!-- , ['class' => 'btn btn-submit'] -->
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection