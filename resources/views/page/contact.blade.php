@extends('app')

@section('title')
	De Bunders - {{ $page->introduction->title }}
@stop

@section('description')
	Dit is de {{ $page->introduction->title }} pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row addmargin">
			{!! Breadcrumbs::render('page.show', (object)['id' => $page->pageId, 'title' => $page->introduction->title]) !!}
		</div>

		<div class="row">
			<div class="col-md-12">
				@include('flash::message')
			</div>
			<div class="col-md-12">
				<h2 class="page-header">
					@if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')	
						<a href="{{ route('page.contactedit')}}" class="right">
							<i class="fa fa-pencil-square-o"></i>
						</a>
					@endif
					{!! $page->introduction->title !!}
				</h2>
			</div>
		</div>
		<div class="row">

			<div class="col-md-8">
				<h4>	
					{!! $page->introduction->subtitle  !!} 
				</h4>
			</div>
			<div class="panel-body col-md-8">
				{!! nl2br($page->introduction->text) !!}
			</div>
			@if(isset($sidebar))
				@include('partials/_sidebar')
			@endif
		</div>

		<div class="row">
			<div class="col-md-8 addmargin">
				@include('errors.partials._list')
				{!! Form::open(['method' => 'POST', 'route' => 'page.sendcontact']) !!}

				{!! Form::label('name', 'Naam') !!}
				{!! Form::text('name', '', ['class' => 'form-control addmargin', 'placeholder' => 'Naam'])!!}

				{!! Form::label('email', 'Email-adres') !!}
				{!! Form::text('email', '', ['class' => 'form-control addmargin', 'placeholder' => 'Emailadres'])!!}

				{!! Form::label('subject', 'Onderwerp') !!}
				{!! Form::text('subject', '', ['class' => 'form-control addmargin', 'placeholder' => 'Onderwerp'])!!}

				{!! Form::label('message', 'Bericht') !!}
				{!! Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Uw vraag'])!!}
			</div>
			<div class="col-md-8">
				{!! Form::submit('Verstuur', ['class' => 'btn btn-primary']) !!}
			</div>
		</div>
	</div>
@stop