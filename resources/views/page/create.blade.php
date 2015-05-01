@extends('app')

@section('content')
    <div class="container">
    	<div class="row">
				{!! Breadcrumbs::render('newpage') !!}
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
            <div class="row col-md-5">
            	<input type="text" name="panelIndex" id="panelIndex" class="hiddenInput" />
				<div class="form-group col-md-8">
				{!! Form::label('title', 'Titel', ['class' => 'label-form'])!!}
				{!! Form::text('title', old('title') , ['class' => 'form-control', 'placeholder' => 'Titel']) !!}
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
						<label class="btn btn-default">
						<input type="radio" name="sidebar" value="false" checked="true">Nee
						</label>
					</div>
				</div>

				</div>

			</div>

			 <div class="row col-md-12">
				<div class="form-group col-md-12">
				{!! Form::label('content', 'Inhoud', ['class' => 'label-form'])!!}
				{!! Form::textarea('content', old('content'), ['placeholder' => 'Inhoud', 'class' => 'form-control', 'id' => 'summernote', 'rows' => '6']) !!}	</div>
			</div>


			<!-- div for new panels -->
			<div class="row col-md-8">
				<div class="col-md-12 form-group" id="newPanels">
					
				</div>
			</div>


			

			<div class="row col-md-8">
				<div class="form-group">
					{!! HTML::linkRoute('admin.index', 'Annuleer', [] ,['class' => 'btn btn-danger']) !!}
					{!! Form:: submit('Opslaan', ['class' => 'btn btn-success'])!!}
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