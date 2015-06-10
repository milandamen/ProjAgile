@extends('app')

@section('title')
	De Bunders - {{ $query ? : '' }}
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
			@if(isset($categories))
				@include('search.partials._category', ['title' => 'Nieuws', 'categories' => $news])
				@include('search.partials._category', ['title' => 'Paginas', 'categories' => $pages])
			@endif
		</div>
	</div>
@stop