@extends('app')
@section('content')

<div class="row">
	<div class="col-md-8">
		<div class="title">Laravel 5</div>
		<div class="quote">{{ Inspiring::quote() }}</div>
	</div>
</div>

@endsection
