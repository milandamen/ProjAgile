@extends('App')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nieuws wijzigen</h1>
            </div>
        </div>

        <div class="col-lg-12">
            {!! Form::model($newsItem, ['method' => 'PATCH', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Titel') !!}
                    {!! Form::text('title', old($newsItem->title), ['placeholder' => 'Titel', 'class' => 'form-control', 'id' => 'summernote']) !!}
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
                    {!! Form::label('hidden', 'Verbergen?') !!}<br/>
                    <div name="hide" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default {{ $newsItem->hidden ? 'active' : '' }}">
                            <input type="radio" name="hidden" value="true" {{ $newsItem->hidden ? 'checked=true' : '' }}>Ja
                        </label>
                        <label class="btn btn-default {{ !$newsItem->hidden ? 'active' : '' }}">
                            <input type="radio" name="hidden" value="false" {{ !$newsItem->hidden ? 'checked=true' : '' }}>Nee
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('commentable', 'Reacties Toestaan?') !!}<br/>
                    <div name="hide" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default {{ $newsItem->commentable ? 'active' : '' }}">
                            <input type="radio" name="commentable" value="true" {{ $newsItem->commentable ? 'checked=true' : '' }}>Ja
                        </label>
                        <label class="btn btn-default {{ !$newsItem->commentable ? 'active' : '' }}">
                            <input type="radio" name="commentable" value="false" {{ !$newsItem->commentable ? 'checked=true' : '' }}>Nee
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('publishStartDate', 'Publicatiedatum') !!}
                    <div class="input-group date" id="datetimepicker">
                        {!! Form::text('publishStartDate', old($newsItem->publishStartDate), ['class' => 'form-control']) 
                            . '<span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>' 
                        !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('publishEndDate', 'Einde Publicatiedatum') !!}
                    <div class="input-group date" id="datetimepicker">
                        {!! Form::text('publishEndDate', old($newsItem->publishEndDate), ['class' => 'form-control'])
                            . '<span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>' 
                        !!}
                </div>

                <div class="form-group">
                    {!! Form::label('onTop', 'Bovenaan de pagina?') !!}<br/>
                    <div name="onTop" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default {{ $newsItem->top ? 'active' : '' }}">
                            <input type="radio" name="top" value="true" {{ $newsItem->top ? 'checked=true' : '' }}>Ja
                        </label>
                        <label class="btn btn-default {{ !$newsItem->top ? 'active' : '' }}">
                            <input type="radio" name="top" value="false" {{ !$newsItem->top ? 'checked=true' : '' }}">Nee
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fileUpload', 'Files toevoegen') !!}<br/>
                    <table name="fileUpload">
                        @foreach($files as $file)
                            {!! '<tr>
                                <td style="padding-top:5px;">' . Form::text($file->fileId, $file->path, ['style' => 'width:500px;']) . '</td>' !!}
                                <td style="padding-top:5px;">
                                    <button id="{!! $file->fileId !!}" style="margin-left: 10px" type="button" class="btn btn-danger" aria-label="Left Align">
                                        <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        {!! '<tr>
                            <td style="padding-top:5px;">' . Form::file('Voeg een nieuwe file toe') . '</td>' !!}
                            <td style="padding-top:5px;">
                                <button id="newFile" style="margin-left: 10px" type="button" class="btn btn-success" aria-label="Left Align">
                                    <span class="glyphicon glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="form-group">
                    {!! Form::submit('opslaan', ['class' => 'btn btn-default']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('additional_scripts')
    {!! HTML::script('custom/js/newsValidate.js') !!}
@stop