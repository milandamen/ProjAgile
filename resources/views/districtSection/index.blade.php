@extends('app')

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

						{{--*/ $curDate = date('Y-m-d H:i:s', time());
						 $count = 0; /*--}}
						@foreach($districts as $district)
							<tr>
								<td><a href="{!! route('district.show', $district->name)!!}"> {!! $district->name !!} </a> </td>
								 {{--*/ $phrase = trunc($district->generalInfo, 20); /*--}}
								<td><i> {!! $phrase !!} </i></td>
								<td> </td>

								@foreach($district->news as $news)
									@if($news->publishStartDate < $curDate && $news->publishEndDate > $curDate && !$news->hidden)
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


