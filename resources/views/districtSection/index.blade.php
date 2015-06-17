@extends('app')

@section('title')
	De Bunders - Deelwijken
@stop

@section('description')
	Dit is de deelwijken overzichts pagina van De Bunders.
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

		<div class="row addmargin">
			<div class="col-md-8">
				<p>
					Het overzicht met alle beschikbare deelwijken. 
					//(Per deelwijk kan het nieuws bekeken worden 
					en welke pagina's er aan vast zitten.)
				</p>
			</div>
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
						</tr>

						{{--*/ $curDate = date('d-m-Y H:i', time());
						 	$count = 0; 
							$current = strtotime($curDate);
						/*--}}
						@foreach($districts as $district)
							{{--*/	$count = 0; /*--}}
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
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection


