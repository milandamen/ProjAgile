@extends('app')

@section('title')
	De Bunders - Deelwijk beheren
@stop

@section('description')
	Dit is de beveiligde deelwijk beheer pagina van De Bunders.
@stop

@section('content')
	 <div class="container">
		<div class="row">
			{!! Breadcrumbs::render('district.index') !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">
					Deelwijken
				</h2>
			</div>
		</div>

		<div class="row">
			@include('flash::message')
		</div>

		<div class="row addmargin">
			<div class="col-md-8">
				<p>
					Het overzicht met alle beschikbare deelwijken. 
					//(Per deelwijk kan het nieuws bekeken worden 
					en welke pagina's er aan vast zitten.)
				</p>
			</div>
				{!! link_to_route('district.create', 'Nieuwe deelwijk', [], ['class' => 'btn btn-success white ']) !!}
				{!! link_to_route('management.index', 'Terug naar Beheer', [], ['class' => 'btn btn-danger white addright addmargin']) !!}
			
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="col-md-12 addmargin">
					<table class="table">
						<tr>
							<th> Deelwijk</th>
							<th> Informatie </th>
							<th> Pagina's  #</th>
							<th> Nieuws #</th>
							<th colspan="3">Acties</th>
						</tr>

						{{--*/  
							$curDate = date('d-m-Y H:i', time());
							$count = 0; 
							$current = strtotime($curDate);
						/*--}}
						@foreach($districts as $district)
							{{--*/	
								$count = 0; 
							/*--}}
							<tr>
								<td><a href="{!! route('district.show', $district->name)!!}"> {!! $district->name !!} </a> </td>
								 {{--*/ $phrase = trunc($district->generalInfo, 20); /*--}}
								<td><i> {!! $phrase !!} </i></td>
								<td> </td>

								@foreach($district->news as $news)
									{{--*/
										$endDate = strtotime($news->publishEndDate);
										$pubDate = strtotime($news->publishStartDate);
									/*--}}
									@if($pubDate <= $current && $endDate >= $current && !$news->hidden)
										{{--*/	$count++; /*--}}
									@endif
								@endforeach
								<td> {!! $count !!}</td>
								<td>
									<a href="{{ route('district.show', [$district->name]) }}"> 
										<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
									</a>
								</td>
								<td>
									<a class="right" href="{{ route('district.edit', [$district->districtSectionId]) }}">
										<i class="fa fa-pencil-square-o fa-lg"></i>
									</a>
								</td>
								<td>
									<a href="{{ route('district.destroy', [$district->districtSectionId]) }}" onclick="confirmDelete()">
											<i class="fa fa-times fa-lg text-danger"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop
