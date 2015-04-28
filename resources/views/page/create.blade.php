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

            {!! Form:: open() !!}
            @include('errors.partials._list')
            <div class="row col-md-8">
				<div class="form-group">
				{!! Form::label('title', 'Titel', ['class' => 'label-form'])!!}
				{!! Form::text('title', old('title') , ['class' => 'form-control', 'placeholder' => 'Titel']) !!}
				</div>
			</div>

			 <div class="row col-md-8">
				<div class="form-group">
				{!! Form::label('content', 'Inhoud', ['class' => 'label-form'])!!}
				{!! Form::text('content', old('content') , ['class' => 'form-control', 'placeholder' => 'Inhoud','id' => 'summernote']) !!}
				</div>
			</div>

			<div class="row col-md-8">
				<div class="col-md-4 form-group">
					{!! Form::label('sidebar', 'Sidebar toevoegen') !!}<br/>
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-default">
						<input type="radio" name="sidebar" value="true" >Ja
						</label>
						<label class="btn btn-default">
						<input type="radio" name="sidebar" value="false">Nee
						</label>
					</div>
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
@endsection