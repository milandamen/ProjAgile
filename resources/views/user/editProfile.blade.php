@extends('app')

@section('content')
	<div class="container">
			{!! Breadcrumbs::render('user.editProfile') !!}
		<div class="row">
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Profiel wijzigen</h1>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="col-lg-12">
			@include('errors.partials._list')
			{!! Form::model($user, ['route' => 'user.updateProfile', 'method' => 'PATCH']) !!}
				@include('user.partials._createEdit', ['editMode' => true])
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop