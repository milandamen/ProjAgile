@extends('app')


@section('title')
	De Bunders - Pagina Aanmaken
@stop

@section('description')
	Dit is de beveiligde pagina aanmaak pagina van De Bunders.
@stop




@section('content')
    <div class="container">
    	<div class="row">
				{!! Breadcrumbs::render('page.create') !!}
			</div>

		<div class="row">
			<div class="col-md-12">
			    <h1>Nieuwe pagina</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

			@include('errors.partials._list')
			{!! Form:: open() !!}
			<input type="text" name="panelIndex" id="panelIndex" class="hiddenInput" />
				<input id="newOnSiteCheck" type="hidden" name="toNewOnSite" value="FALSE">
			<input id="newOnSiteMessage" type="hidden" name="newOnSiteMessage" value="">
			<div class="row col-md-5">
				<div class="form-group col-md-12">
				{!! Form::label('parent', 'Selecteer bovenliggende pagina', ['class' => 'label-form']) !!}
				{!! Form::select('parent', ['Geen']+ $pages, 0, ['id' => 'parentname', 'class' => 'form-control']) !!}
				</div>
			</div>

			<div class="row col-md-7">
				<div class="col-md-8 form-group">
					{!! Form::label('extra', 'Extra opties', ['class' => 'label-form'])!!} <br/>
					{!!  Form:: button('Mini vak', ['class' => 'btn btn-default', 'onclick' => 'newPanel(2)']) !!}
					{!!  Form:: button('Klein vak',['class' => 'btn btn-default', 'onclick' => 'newPanel(4)']) !!}
					{!!  Form:: button('Medium vak',['class' => 'btn btn-default', 'onclick' => 'newPanel(8)']) !!}
					{!!  Form:: button('Groot vak', ['class' => 'btn btn-default', 'onclick' => 'newPanel(12)']) !!}

				</div>
				<div class="col-md-4 form-group">
					<div class="col-md-12 form-group">
						{!! Form::label('sidebar', 'Sidebar toevoegen') !!}<br/>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-default">
							<input type="radio" name="sidebar" value="true">Ja
							</label>
							<label class="btn btn-default active">
							<input type="radio" name="sidebar" value="false" checked="true">Nee
							</label>
						</div>
					</div>
				</div>
			</div>

			

				<div class="row col-md-5">
					<div class="form-group col-md-12">
					{!! Form::label('publishStartDate', 'Publicatiedatum') !!}
					<div class="input-group date">
						{!! Form::text('publishStartDate', old('publishStartDate'), ['class' => 'form-control']) 
							. '<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>' 
						!!}
					</div>
				</div>
				</div>
				
				<div class="row col-md-7 no-padding">
					<div class="col-md-8">
						<div class="form-group col-md-11">
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
			
					<div class=" col-md-4 form-group">
						<div class="form-group col-md-12">
						{!! Form::label('visible', 'Verborgen Pagina') !!}<br/>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-default">
								<input type="radio" name="visible" value="true">Ja
							</label>
							<label class="btn btn-default active">
								<input type="radio" name="visible" value="false" checked="true">Nee
							</label>
						</div>
					</div>
				</div>
			</div>


			 <div class="row col-md-5">
				<div class="form-group col-md-12">
					{!! Form::label('title', 'Titel', ['class' => 'label-form'])!!}
					{!! Form::text('title', null , ['class' => 'form-control', 'placeholder' => 'Titel']) !!}
				</div>
			</div>

			 <div class="row col-md-6">
				<div class="form-group col-md-8">
					{!! Form::label('subtitle', 'Subtitel', ['class' => 'label-form'])!!}
					{!! Form::text('subtitle', null , ['class' => 'form-control', 'placeholder' => 'Subtitel']) !!}
				</div>
			</div>

			 <div class="row col-md-12">
				<div class="form-group col-md-12">
					{!! Form::label('content', 'Inhoud', ['class' => 'label-form'])!!}
					{!! Form::textarea('content', null, ['placeholder' => 'Inhoud', 'class' => 'form-control', 'id' => 'summernote', 'rows' => '6']) !!}	
				</div>
			</div>


			<!-- div for new panels -->
			<div class="row col-md-8">
				<div class="col-md-12 form-group" id="newPanels">
				</div>
			</div>


			<div class="row col-md-8">
				<div class="form-group">
					{!! HTML::linkRoute('page.index', 'Annuleer', [] ,['class' => 'btn btn-danger']) !!}
					{!! Form:: submit('Opslaan', ['class' => 'btn btn-success', 'onclick' => 'validatePage()'])!!}
				</div>
			</div>

			<!--</form>-->
			{!! Form:: close() !!}
           	</div>
           </div>
        </div>
    </div>
@endsection



@section('additional_scripts')
    <!-- include summernote js-->
    {!! HTML::script('summernote/js/summernote.js') !!}
    {!! HTML::script('custom/js/summernoteFunctions.js') !!}
    {!! HTML::script('custom/js/page.js') !!}
    {!! HTML::script('custom/js/validateNewOnSite.js') !!}
    {!! HTML::script('moment/moment.js') !!}
	{!! HTML::script('moment/locale/nl.js') !!}
	{!! HTML::script('bootstrap/js/bootstrap-datetimepicker.js') !!}
	{!! HTML::script('custom/js/datepicker.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
@endsection