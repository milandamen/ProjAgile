@extends('app')

@section('title')
	De Bunders - {{ $page->introduction->title }} Wijzigen
@stop

@section('description')
	Dit is de beveiligde {{ $page->introduction->title }} wijzig pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('page.edit', (object)['id' => $page->pageId, 'title' => $page->introduction->title]) !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1>Pagina Wijzigen</h1>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-md-12">
				@include('errors.partials._list')
				{!! Form::model($page, ['method' => 'POST']) !!}
					
						<input type="text" name="panelIndex" id="panelIndex" class="hiddenInput"/>
						<input id="newOnSiteCheck" type="hidden" name="toNewOnSite" value="FALSE">
						<input id="newOnSiteMessage" type="hidden" name="newOnSiteMessage" value="">
						<input type="text" name="intro_id" id="intro_id" value="{!! $page->introduction->introductionId !!}" class="hiddenInput"/>
					
					<div class="row col-md-5">
						<div class="form-group col-md-12">
						{!! Form::label('parent', 'Selecteer bovenliggende pagina', ['class' => 'label-form']) !!}
						{!! Form::select('parent', [0 => 'Geen']+ $pages, $page->parentId, ['id' => 'parentname', 'class' => 'form-control']) !!}
						</div>
					</div>

						
					<div class="row col-md-7">
						<div class="col-md-8 form-group">
							{!! Form::label('extra', 'Extra opties', ['class' => 'label-form'])!!} 
							<br/>
							{!! Form::button('Mini vak', ['class' => 'btn btn-default', 'onclick' => 'newPanel(2)']) !!}
							{!! Form::button('Klein vak', ['class' => 'btn btn-default', 'onclick' => 'newPanel(4)']) !!}
							{!! Form::button('Medium vak',['class' => 'btn btn-default', 'onclick' => 'newPanel(8)']) !!}
							{!! Form::button('Groot vak', ['class' => 'btn btn-default', 'onclick' => 'newPanel(12)']) !!}
						</div>
						<div class="col-md-4 form-group">
							<div class="col-md-12 form-group">
								{!! Form::label('sidebar', 'Sidebar toevoegen') !!}<br/>
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default {{ $page->sidebar ? 'active' : '' }}">
										<input id="sidebarOn" type="radio" name="sidebar" value="true" {!! $page->sidebar ? 'checked=true' : '' !!}>Ja
									</label>
									<label class="btn btn-default {{ !$page->sidebar ? 'active' : '' }}">
										<input id="sidebarOff" type="radio" name="sidebar" value="false" {!! !$page->sidebar ? 'checked=true' : '' !!}>Nee
									</label>
								</div>
							</div>
						</div>
					</div>


					<div class="row col-md-5">
						<div class="form-group col-md-12">
						{!! Form::label('publishStartDate', 'Publicatiedatum') !!}
						<div class="input-group date">
							{!! Form::text('publishStartDate', $page->publishDate, ['class' => 'form-control']) 
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
						{!! Form::text('publishEndDate', $page->publishEndDate, ['class' => 'form-control'])
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
							<label class="btn btn-default {{ !$page->visible ? 'active' : '' }}">
								<input type="radio" name="visible" value="false" {{ !$page->visible ? 'checked="true"' : '' }}>Ja
							</label>
							<label class="btn btn-default {{ $page->visible ? 'active' : '' }}">
								<input type="radio" name="visible" value="true" {{ $page->visible ? 'checked="true"' : '' }}>Nee
							</label>
						</div>
					</div>
				</div>
			</div>


			 <div class="row col-md-5">
				<div class="form-group col-md-12">
					{!! Form::label('title', 'Titel', ['class' => 'label-form'])!!}
					{!! Form::text('title', $page->introduction->title , ['class' => 'form-control title', 'placeholder' => 'Titel']) !!}
				</div>
			</div>

			 <div class="row col-md-7 no-padding">
				<div class="col-md-8">
					<div class="form-group col-md-11">
					{!! Form::label('subtitle', 'Subtitel', ['class' => 'label-form'])!!}
					{!! Form::text('subtitle', $page->introduction->title , ['class' => 'form-control subtitle', 'placeholder' => 'Subtitel']) !!}
					</div>
				</div>
			</div>

			<div class="row col-md-12">
				<div class="form-group col-md-12">
					{!! Form::label('content', 'Inhoud', ['class' => 'label-form'])!!}
					{!! Form::textarea('content', $page->introduction->text , ['placeholder' => 'Inhoud', 'class' => 'form-control introductie', 'id' => 'summernote', 'rows' => '6']) !!}	
				</div>
			</div>
			<!-- div for new panels -->
			<div class="row col-md-8">
				<div class="col-md-12 form-group" id="newPanels">
					{{--*/ $i = 0; /*--}}
					@foreach($page->panels as $panel)	
						{{-- Loop all panels --}}
						<div>
							<h4>Vak met grootte {!! $panel->panel->size !!} 
								<a onclick="removePanel(this)" class="btn btn-danger btn-xs white"> Verwijder paneel</a>
								<a onclick="up(this)" class="btn btn-primary white btn-xs addright">
									<i class="fa fa-arrow-up"></i>
								</a>  
								<a onclick="down(this)" class="btn btn-primary white btn-xs addright">
									<i class="fa fa-arrow-down"></i>
								</a>
							</h4>
							<input type="text" class="form-control titlevalue"  placeholder="Titel" name="panel[{!!$i!!}][title]" value="{!! $panel->title !!}"/>
							<br/>
							<textarea class="summer form-control" name="panel[{!!$i!!}][content]" placeholder="Inhoud" rows="6">{!! $panel->text !!}</textarea>
							<input type="number" class="sizevalue" name="panel[{!!$i!!}][size]"  value="{!! $panel->panel->size  !!}" hidden/>
							<input type="number" name="panel[{!!$i!!}][id]"  value="{!! $panel->pagepanelId  !!}" hidden/>
						</div>
						{{--*/ $i++; /*--}}
					@endforeach					
				</div>
			</div>

			<div class="row col-md-8">
				
				<div class="form-group col-md-12" id="newOnSiteGroupPage">
					<div class="col-md-4">
						{!! Form::label('newOnSite', 'Tonen nieuw op de site?', ['class' => 'label-form']) !!}<br/>
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
		
				<div class="form-group">
					{!! link_to_route('page.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
					<a onclick="getPreview()" class="btn btn-warning">Preview</a>
					{!! Form::submit('Opslaan', ['class' => 'btn btn-success', 'onclick' => 'validatePage()'])!!}
				</div>
			</div>
				{!! Form:: close() !!}
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="preview">
					<div class="row previewMenu">

					</div>
					<div class="previewTitles">
					</div>
					<div class="row side">
					</div>
					<div class="row" id="previewPanels">
					</div>
						<a onclick="hidePreview()" class="btn btn-danger" style="width: 100%; height: 40px; margin-bottom: 10px">Hide preview</a> 
				</div>
			</div>
		</div>
	</div>

@stop

@section('additional_scripts')
	{!! HTML::script('summernote/js/summernote.js') !!}
	{!! HTML::script('custom/js/summernoteFunctions.js') !!}
	{!! HTML::script('custom/js/page.js') !!}
  	{!! HTML::script('custom/js/validateNewOnSite.js') !!}
  	{!! HTML::script('moment/moment.js') !!}
	{!! HTML::script('moment/locale/nl.js') !!}
	{!! HTML::script('bootstrap/js/bootstrap-datetimepicker.js') !!}
	{!! HTML::script('custom/js/datepicker.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop