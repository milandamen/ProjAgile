@extends('app')

@section('title')
	De Bunders - Contact pagina Wijzigen
@stop

@section('description')
	Dit is de beveiligde contact wijzig pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('page.edit', (object)['id' => $page->pageId, 'title' => $page->introduction->title]) !!}
		</div>
		<div class="row">
			<div class="col-md-8">
				<h1>Contact Wijzigen</h1>
				<p > 
					Op deze pagina kan de tekst van de introductie aangepast worden. Hieronder ziet u de huidige introductie, die u kunt wijzigen naar wat u wilt. 
				</p>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type="hidden" name="pageId" value="1">
				@include('errors.partials._list')
				{!! Form::model($introduction, ['method' => 'POST', 'onsubmit' => 'newOnSiteValidate();'])!!}
					{!! Form::hidden('pageId', 1) !!}
					<div class="row col-md-8">
						<div class="form-group">
						{!! Form::label('title', 'Titel', ['class' => 'label-form'])!!}
						{!! Form::text('title', $introduction->title, ['class' => 'form-control', 'placeholder' => 'titel']) !!}
						</div>
					</div>
					<div class="row col-md-8">
						<div class="form-group">
							{!! Form::label('subtitle', 'Subtitel', ['class' => 'label-form'])!!}
							{!! Form::text('subtitle', $introduction->subtitle, ['class' => 'form-control', 'placeholder' => 'Subtitel']) !!}
						</div>
					</div>
					<div class="row col-md-8">
						<div class="form-group">
							{!! Form::label('content', 'Content', ['class' => 'label-form']) !!}
							{!! Form::textarea('content', $introduction->text, ['placeholder' => 'Introductie tekst', 'class' => 'form-control', 'id' => 'summernote', 'rows' => '6']) !!}
						</div>
					</div>
					<!--new on site-->
					<div class="row">
						<div class="form-group col-md-12" id="newOnSiteGroupPage">
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
					<div class="row col-md-8">
						<div class="form-group">
							{!! HTML::linkRoute('management.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
							{!! Form::submit('Opslaan', ['class' => 'btn btn-success'])!!}
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('summernote/js/summernote.js') !!}
	{!! HTML::script('custom/js/summernoteFunctions.js') !!}
	{!! HTML::script('custom/js/validateNewOnSite.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop