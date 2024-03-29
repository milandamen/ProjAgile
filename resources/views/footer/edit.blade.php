@extends('app')

@section('title')
	De Bunders - Footer Wijzigen
@stop

@section('description')
	Dit is de beveiligde footer wijzig pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('footer.edit') !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1>Footer Wijzigen</h1>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-lg-12">
				{!! Form::open(['route' => 'footer.update', 'method' => 'POST', 'onsubmit' => 'newOnSiteValidate();']) !!}
				<hr/>
				@if(count($footer) < 4)
					<h3>Er is een probleem met de footer tabel in de database, er moeten 4 lege velden aanwezig zijn met id's 1 t/m 4!</h3>
				@endif
				@if(count($footer) > 3)
					{{-- -1, because id 4 is for the color --}}
					@for($c = 0; $c < count($footer) - 1; $c++)
						<div class="col-md-4 footerCol">
							<h2>Kolom {{$c + 1}}</h2>
							{!! Form::textarea('column[]', $footer[$c]->text, ['placeholder' => 'Tekst', 'class' => 'form-control summernote']) !!}
						</div>
					@endfor
					<div class="row">
						<div class="form-group col-sm-4">
							<br/>
							<label class="control-label col-sm-2">Kleur:</label>
							<div class="col-sm-10">
								<div id="picker">{!! Form::hidden('footerColor', $footer[3]->text, ['class' => 'footerColor', 'id' => 'footerColor']) !!}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-8" id="newOnSiteGroupPage">
							<div class="col-md-5">
							{!! Form::label('newOnSite', 'Tonen op nieuw op de site?', ['class' => 'label-form']) !!}<br/>
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
					</div>
					<div id="success" class="col-lg-12">
						<br/>
						<button type="button" class="btn btn-danger" onclick="location.href='{{ route('management.index') }}'">Annuleren</button>
						<a onclick="getPreview()" class="btn btn-warning">Preview</a>
						{!! Form::submit("Opslaan", ['class' => 'btn btn-success']) !!}
					</div>
				@endif
				{!! Form::close() !!}
			</div>
		</div>
		<div class="col-md-12">
			<div class="preview">
				<div class="previewFooter addmargin">
				</div>
				<a onclick="hidePreview()" class="btn btn-danger hidepreview" >Hide preview</a> 	
			</div>
		</div>
	</div>
	<script>
		//set the color in colorpicker from db
		var color = "{!! $footer[3]->text !!}";
	</script>
@endsection

@section('additional_scripts')
	{!! HTML::script('summernote/js/summernote.js') !!}
	{!! HTML::script('custom/js/summernoteFunctions.js') !!}
	{!! HTML::script('custom/js/validateNewOnSite.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
	{!! HTML::script('custom/js/footer.js') !!}
	{!! HTML::script('custom/js/colorpicker/colpick.js') !!}
	{!! HTML::script('custom/js/colorpicker/footer.js') !!}
@stop