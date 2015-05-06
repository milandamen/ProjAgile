@extends('app')

@section('content')
<div class="container">
	    	<div class="row">
				{!! Breadcrumbs::render('editintroduction') !!}
			</div>

	<div class="row">
		<div class="col-md-8">
		
			<h1>Wijzig  introductie </h1>
			<p > 
				Op deze pagina kan de tekst van de introductie aangepast worden. De introductie is voornamelijk gericht op de home-pagina maar kan eventueel ook ingezet worden op andere pagina's. Hieronder ziet u de huidige introductie, die u kunt wijzigen naar wat u wilt. 

			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">

			{!! Form:: open() !!}
            <input id="newOnSiteCheck" type="hidden" name="toNewOnSite" value="FALSE">
            <input id="newOnSiteMessage" type="hidden" name="newOnSiteMessage" value="">
			<input type="hidden" name="pageId" value="{!! $introduction->pageId !!}" >

			@include('errors.partials._list')
			{!! Form::model($introduction, ['method' => 'POST'])!!}
				{!! Form::hidden('pageId', $introduction->pageId) !!}

			<div class="row col-md-8">
				<div class="form-group">
				{!! Form::label('title', 'Titel', ['class' => 'label-form'])!!}
				{!! Form::text('title', $introduction->title, ['class' => 'form-control', 'placeholder' => 'titel']) !!}
				</div>
			</div>


			 <div class="row col-md-8">
				<div class="form-group">
				{!! Form::label('subtitle', 'Subtitel', ['class' => 'label-form'])!!}
				{!! Form::text('subtitle', old('subtitle') , ['class' => 'form-control', 'placeholder' => 'Subtitel']) !!}
				</div>
			</div>

			<div class="row col-md-8">
				<div class="form-group">
					{!! Form::label('content', 'Content', ['class' => 'label-form']) !!}
					{!! Form::textarea('content', $introduction->text, ['placeholder' => 'Introductie tekst', 'class' => 'form-control', 'id' => 'summernote', 'rows' => '6']) !!}
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
    {!! HTML::script('custom/js/validateNewOnSite.js') !!}
@endsection
