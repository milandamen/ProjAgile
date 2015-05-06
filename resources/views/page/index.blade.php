@extends('app')


@section('content')

	 <div class="container">
	 	<div class="row">
			{!! Breadcrumbs::render('pages') !!}
		</div>

            <div class="row">	
                <div class="col-md-12">
                    <h2 class="page-header">
                        Pagina overzicht
                    </h2>
                </div>
            </div>

             <div class="row">
             	<div class="col-md-12">
         		     <p class="col-md-8"> 
         		     	Deze pagina is enkel zichtbaar voor de administrator en toont 
                    	alle pagina's. 
                    </p>
                    {!! link_to_route('page.create', 'Nieuwe pagina', [], array('class' => 'btn btn-success white')) !!}
             	<div class="col-md-12 addmargin">
					
					<table class="table">
						<thead> 
							<tr>
								<th> Titel </th>
								<th> Inhoud </th>
								<th></th>
								<th colspan="3"> Acties </th>								
							</tr>
						</thead>
						
						<tbody>
						@foreach($pages as $page)
							<tr>
								<td> {!! $page->introduction->title	!!}</td>
								{{--*/ $phrase = trunc($page->introduction->text, 30); /*--}}
								<td> {!! $phrase !!}	</td>
								<td>	</td>
								
								<td> 
									<a class="right" href="{{ route('page.edit', [$page->pageId]) }}">
										<i class="fa fa-pencil-square-o"></i>
									</a>
								</td>
								<td>
									<a class="right" href="{{ route('page.del', [$page->pageId]) }}">
										<i class="fa fa-times text-danger"></i>
									</a>
								</td>
								<td> 
									<a href="{{ route('page.show', [$page->pageId]) }}"> 
										<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
									</a>
								</td>
								
							</tr>
						@endforeach
					</tbody>
					</table>
				</div>
			</div>
				
			</div>

@endsection