@extends('app')

@section('title')
	De Bunders Zoeken - {{ $query ? : '' }}
@stop

@section('description')
	Dit is de zoekopdracht resultaten scherm van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('search.index', $query ? : '') !!}
		</div>
		<div class="row">
			@if(!isset($categories))
				@foreach($categories as $category)
					@include('search.partials._category', ['title' => 'Nieuws', 'category' => $category])
				@endforeach
			@endif
		</div>
	</div>
@stop