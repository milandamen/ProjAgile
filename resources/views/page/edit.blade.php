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
					<div class="row col-md-5">
						<input type="text" name="panelIndex" id="panelIndex" class="hiddenInput"/>
						<input id="newOnSiteCheck" type="hidden" name="toNewOnSite" value="FALSE">
						<input id="newOnSiteMessage" type="hidden" name="newOnSiteMessage" value="">
						<input type="text" name="intro_id" id="intro_id" value="{!! $page->introduction->introductionId !!}" class="hiddenInput"/>
						<div class="form-group col-md-8">
							{!! Form::label('title', 'Titel', ['class' => 'label-form'])!!}
							{!! Form::text('title', $page->introduction->title , ['class' => 'form-control', 'placeholder' => 'Titel']) !!}
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
										<input type="radio" name="sidebar" value="true" {!! $page->sidebar ? 'checked=true' : '' !!}>Ja
									</label>
									<label class="btn btn-default {{ !$page->sidebar ? 'active' : '' }}">
										<input type="radio" name="sidebar" value="false" {!! !$page->sidebar ? 'checked=true' : '' !!}>Nee
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row col-md-5">
						<div class="form-group col-md-12">
							{!! Form::label('subtitle', 'Subtitel', ['class' => 'label-form'])!!}
							{!! Form::text('subtitle', $page->introduction->subtitle , ['class' => 'form-control', 'placeholder' => 'Subtitel']) !!}
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
									<input type="number" name="panel[{!!$i!!}][size]"  value="{!! $panel->panel->size  !!}" hidden/>
									<input type="number" name="panel[{!!$i!!}][id]"  value="{!! $panel->pagepanelId  !!}" hidden/>
								</div>
								{{--*/ $i++; /*--}}
							@endforeach					
						</div>
					</div>
					<div class="row col-md-8">
						<div class="form-group">
							{!! link_to_route('page.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
							{!! Form::submit('Opslaan', ['class' => 'btn btn-success', 'onclick' => 'validatePage()'])!!}
						</div>
					</div>
				{!! Form:: close() !!}
			</div>
		</div>
	</div>
@stop

@section('additional_scripts')
	<!-- include summernote js-->
	{!! HTML::script('summernote/js/summernote.js') !!}
	{!! HTML::script('custom/js/summernoteFunctions.js') !!}
	{!! HTML::script('custom/js/page.js') !!}
  	{!! HTML::script('custom/js/validateNewOnSite.js') !!}
@stop