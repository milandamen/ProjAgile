<div class="form-group">
    {!! Form::label('title', 'Titel') !!}
    {!! Form::text('title', old('title'), ['placeholder' => 'Titel', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('content', 'Content') !!}
    {!! Form::textarea('content', old('content'), ['placeholder' => 'Content', 'class' => 'form-control', 'id' => 'summernote']) !!}
</div>
<div class="form-group">
    {!! Form::label('districtSection', 'Sectie') !!}
    {!! Form::select('districtSectionId', ['0' => 'Home'] + $districtSections, old('districtSectionId'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('publishStartDate', 'Publicatiedatum') !!}
    <div class="input-group date" id="datetimepicker">
        {!! Form::text('publishStartDate', old('publishStartDate'), ['class' => 'form-control']) 
            . '<span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>' 
        !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('publishEndDate', 'Einde Publicatiedatum') !!}
    <div class="input-group date" id="datetimepicker">
        {!! Form::text('publishEndDate', old('publishEndDate'), ['class' => 'form-control'])
            . '<span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>' 
        !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('fileUpload', 'File Toevoegen') !!}<br/>
    <table name="fileUpload">
    @if(isset($files))
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
    @endif
        {!! '<tr>
            <td style="padding-top:5px;">' . Form::file('file[0]') . '</td>' !!}
        </tr>
    </table>
</div>
<div class="form-group col-md-12">
    <div class="col-md-2">
        {!! Form::label('hidden', 'Verbergen?') !!}<br/>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default {{ $newsItem->hidden ? 'active' : '' }}">
                <input type="radio" name="hidden" value="true" {{ $newsItem->hidden ? 'checked=true' : '' }}>Ja
            </label>
            <label class="btn btn-default {{ !$newsItem->hidden ? 'active' : '' }}">
                <input type="radio" name="hidden" value="false" {{ !$newsItem->hidden ? 'checked=true' : '' }}>Nee
            </label>
        </div>
    </div>
    <div class="col-md-2">
        {!! Form::label('commentable', 'Reacties Toestaan?') !!}<br/>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default {{ $newsItem->commentable ? 'active' : '' }}">
                <input type="radio" name="commentable" value="true" {{ $newsItem->commentable ? 'checked=true' : '' }}>Ja
            </label>
            <label class="btn btn-default {{ !$newsItem->commentable ? 'active' : '' }}">
                <input type="radio" name="commentable" value="false" {{ !$newsItem->commentable ? 'checked=true' : '' }}>Nee
            </label>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::label('onTop', 'Bovenaan de Pagina?') !!}<br/>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default {{ $newsItem->top ? 'active' : '' }}">
                <input type="radio" name="top" value="true" {{ $newsItem->top ? 'checked=true' : '' }}>Ja
			</label>
            <label class="btn btn-default {{ !$newsItem->top ? 'active' : '' }}">
                <input type="radio" name="top" value="false" {{ !$newsItem->top ? 'checked=true' : '' }}">Nee
            </label>
        </div>
	</div>
</div>
<div class="form-group">
	{!! Form::submit($submitButton, ['class' => 'btn btn-success']) !!}
	{!! HTML::linkRoute('news.manage', 'Annuleer', [], ['class' => 'btn btn-danger']) !!}
</div>