@extends('app')

@section('content')
    <div class="container">
    	<div class="row">
				{!! Breadcrumbs::render('editpagetitle', (object)['id' => $page->pageId, 'title' => $page->introduction->title]) !!}
			</div>

        <div class="row">
            <div class="col-md-12">
                <h1>Pagina wijzigen</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
			@include('errors.partials._list')
            {!! Form::model($page, ['method' => 'POST']) !!}
            <div class="row col-md-5">
            	<input type="text" name="panelIndex" id="panelIndex" class="hiddenInput" />
            	<input type="text" name="intro_id" id="intro_id" value="{!! $page->introduction->introductionId !!}" class="hiddenInput" />
				<div class="form-group col-md-8">
				{!! Form::label('title', 'Titel', ['class' => 'label-form'])!!}
				{!! Form::text('title', $page->introduction->title , ['class' => 'form-control', 'placeholder' => 'Titel']) !!}
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

			 <div class="row col-md-12">
				<div class="form-group col-md-12">
				{!! Form::label('content', 'Inhoud', ['class' => 'label-form'])!!}
				{!! Form::textarea('content', $page->introduction->text , ['placeholder' => 'Inhoud', 'class' => 'form-control', 'id' => 'summernote', 'rows' => '6']) !!}	</div>
			</div>

			<!-- div for new panels -->
			<div class="row col-md-8">
				<div class="col-md-12 form-group" id="newPanels">
					{{--*/ $i = 0; /*--}}
					@foreach($page->panels as $panel)	{{-- Loop all panels --}}
						<div>
							<h4>Vak met grootte {!! $panel->panel->size  !!} <a onclick="removePanel(this)" class="btn btn-danger btn-xs white"> Verwijder paneel</a></h4>
							<input type="text" class="form-control"  placeholder="Titel" name="panel[{!!$i!!}][title]" value="{!! $panel->title !!}"/><br/>
							<textarea class="summernote" name="panel[{!!$i!!}][content]" placeholder="Inhoud">{!! $panel->text !!} </textarea>
							<input type="number" name="panel[{!!$i!!}][size]"  value="{!! $panel->panel->size  !!}" hidden/>
							<input type="number" name="panel[{!!$i!!}][id]"  value="{!! $panel->pagepanelId  !!}" hidden/>
						</div>
						{{--*/ $i++; /*--}}
					@endforeach					
				</div>
			</div>

			<div class="row col-md-8">
				<div class="form-group">
					{!! HTML::linkRoute('admin.index', 'Annuleer', [] ,['class' => 'btn btn-danger']) !!}
					{!! Form:: submit('Opslaan', ['class' => 'btn btn-success', 'onclick' => 'validate()'])!!}
				</div>
			</div>

			<!--</form>-->
			{!! Form:: close() !!}
           	</div>
        </div>
    </div>
@endsection



@section('additional_scripts')
    <!-- include summernote js-->
    {!! HTML::script('summernote/js/summernote.js') !!}
    {!! HTML::script('custom/js/summernoteFunctions.js') !!}
    {!! HTML::script('custom/js/page.js') !!}
@endsection