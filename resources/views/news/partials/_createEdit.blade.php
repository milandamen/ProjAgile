<div class="form-group col-md-12 no-padding">
		<h4> Algemene instellingen </h4>
	<div class="col-md-3 no-padding">

		{!! Form::label('publishStartDate', 'Publicatiedatum') !!}
		<div class="input-group date">
			{!! Form::text('publishStartDate', old('publishStartDate'), ['class' => 'form-control']) 
				. '<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>' 
			!!}
		</div>

	</div>
	<div class="col-md-offset-3 col-md-3 no-padding">
		{!! Form::label('publishEndDate', 'Einde Publicatiedatum') !!}
		<div class="input-group date">
			{!! Form::text('publishEndDate', old('publishEndDate'), ['class' => 'form-control'])
				. '<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>' 
			!!}
		</div>
	</div>
</div>
<div class="form-group col-md-12 no-padding addmargin">
	<div class="col-md-3 no-padding">
		{!! Form::label('districtSection', 'Deelwijk(en)') !!}
		<button id="newDistrictSection" type="button" class="btn btn-success btn-xs floatRight" aria-label="Left Align">
			<span class="glyphicon glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
	</div>
	<div id="districts" class="row clear addmargin">
		{{--<div class="col-md-6 districtBox addmargin">--}}
			@if(count($newsItem->districtSections) > 0)

				@foreach($newsItem->districtSections as $district)
					<div class="col-md-6 districtBox addmargin">
						<div class="col-md-6 no-padding">
							{!! Form::select('districtSection[]', $districtSections, $district->districtSectionId, ['class' => 'form-control districtSelect']) !!}
						</div>
						<button name="deleteDistrictSection" style="margin: 5px 0px 0px 5px" type="button" class="btn btn-danger btn-xs deleteDistrictSection" aria-label="Left Align">
							<span class="glyphicon glyphicon glyphicon-remove deleteDistrictSectionSpan" aria-hidden="true"></span>
						</button>
					</div>
				@endforeach

			@else
				<div class="col-md-6 districtBox addmargin">
					<div class="col-md-6 no-padding">
						{!! Form::select('districtSection[]', $districtSections, null, ['class' => 'form-control districtSelect']) !!}
					</div>
					<button name="deleteDistrictSection" style="margin: 5px 0px 0px 5px" type="button" class="btn btn-danger btn-xs deleteDistrictSection" aria-label="Left Align">
						<span class="glyphicon glyphicon glyphicon-remove deleteDistrictSectionSpan" aria-hidden="true"></span>
					</button>
				</div>

			@endif
			{{--<div class="col-md-6 no-padding">--}}
				{{--@if(isset($newsItem->districtSectionId))--}}
					{{--{!! Form::select('districtSection[]', $districtSections, $newsItem->districtSectionId, ['class' => 'form-control districtSelect']) !!}--}}
				{{--@else--}}
					{{--{!! Form::select('districtSection[]', $districtSections, old('districtSectionId'), ['class' => 'form-control districtSelect']) !!}--}}
				{{--@endif--}}
			{{--</div>--}}
				{{--<button name="deleteDistrictSection" style="margin: 5px 0px 0px 5px" type="button" class="btn btn-danger btn-xs deleteDistrictSection" aria-label="Left Align">--}}
					{{--<span class="glyphicon glyphicon glyphicon-remove deleteDistrictSectionSpan" aria-hidden="true"></span>--}}
				{{--</button>--}}
		{{--</div>--}}
	</div>
</div>
<div class="form-group col-md-12 no-padding">
	<h4> Nieuws bericht </h4>
	<div class="col-md-12 no-padding">
		{!! Form::label('title', 'Titel') !!}
	</div>
	<div class="col-md-9 no-padding">
		{!! Form::text('title', old('title'), ['placeholder' => 'Titel', 'class' => 'form-control']) !!}
	</div>
</div>
<div class="form-group col-md-12 no-padding">
	<div class="col-md-12 no-padding">
		{!! Form::label('content', 'Content') !!}
	</div>
	<div class="col-md-9 no-padding">
		{!! Form::textarea('content', old('content'), ['placeholder' => 'Content', 'class' => 'form-control', 'id' => 'summernote']) !!}
	</div>
</div>
<div class="form-group">
	<div class="col-md-12 no-padding addmargin">
		<div class="col-md-9 no-padding">
			{!! Form::label('fileUpload', 'Bestanden Toevoegen') !!}
			<button id="newFile" style="margin-left: 10px" type="button" class="btn btn-success btn-xs floatRight" aria-label="Left Align">
				<span class="glyphicon glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
			</button>
			<table name="fileUpload" class="table col-md-12">
				@if(isset($files))
					@for ($i = 0; $i < count($files); $i++)
						<tr>
							<td><a href="{{ asset('uploads/file/news/' . $files[$i]->path) }}" target="_blank">Bekijk huidig</a></td>
							<td> </td>
						</tr>
					@endfor
					{!! '<tr>
						<td>' . Form::file('file[0]', ['id' => 'file', 'çlass' => 'form-control']) . '</td>' !!}
						<td>
							<button name="deleteFile" type="button" class="btn btn-danger btn-xs floatRight" aria-label="Left Align">
								<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button>
						</td>
					</tr>
				@else
					{!! '<tr>
						<td>' . Form::file('file[0]', ['id' => 'file', 'çlass' => 'form-control']) . '</td>' !!}
						<td style="width: 22px">
							<a name="deleteFile" type="button" class="btn btn-danger btn-xs floatRight" aria-label="Left Align">
								<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
						</td>
					</tr>
				@endif
			</table>
		</div>
	</div>
</div>
<div class="form-group col-md-12 no-padding addmargin">
	<div class="col-md-4 no-padding">
		{!! Form::label('hidden', 'Verbergen?') !!}<br/>
		<div class="btn-group" data-toggle="buttons">
			<label class="btn btn-default {{ $newsItem->hidden ? 'active' : '' }}">
				<input type="radio" name="hidden" value="true" {{ $newsItem->hidden ? 'checked="true"' : '' }}>Ja
			</label>
			<label class="btn btn-default {{ !$newsItem->hidden ? 'active' : '' }}">
				<input type="radio" name="hidden" value="false" {{ !$newsItem->hidden ? 'checked="true"' : '' }}>Nee
			</label>
		</div>
	</div>
	<div class="col-md-4 no-padding addmargin">
		{!! Form::label('commentable', 'Reacties Toestaan?') !!}<br/>
		<div class="btn-group" data-toggle="buttons">
			<label class="btn btn-default {{ $newsItem->commentable ? 'active' : '' }}">
				<input type="radio" name="commentable" value="true" {{ $newsItem->commentable ? 'checked="true"' : '' }}>Ja
			</label>
			<label class="btn btn-default {{ !$newsItem->commentable ? 'active' : '' }}">
				<input type="radio" name="commentable" value="false" {{ !$newsItem->commentable ? 'checked="true"' : '' }}>Nee
			</label>
		</div>
	</div>
	<div class="col-md-3 no-padding addmargin">
		{!! Form::label('onTop', 'Bovenaan de Pagina?') !!}<br/>
		<div class="btn-group" data-toggle="buttons">
			<label class="btn btn-default {{ $newsItem->top ? 'active' : '' }}">
				<input type="radio" name="top" value="true" {{ $newsItem->top ? 'checked="true"' : '' }}>Ja
			</label>
			<label class="btn btn-default {{ !$newsItem->top ? 'active' : '' }}">
				<input type="radio" name="top" value="false" {{ !$newsItem->top ? 'checked="true"' : '' }}">Nee
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="col-md-12 no-padding">
		{!! link_to_route('news.manage', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
		{!! Form::submit('Opslaan', ['class' => 'btn btn-default']) !!}
	</div>
</div>