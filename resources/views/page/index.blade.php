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
             	<div class="col-md-10 addmargin">
					
					<table class="table borderless">
						<thead> 
							<tr>
								<th> Titel </th>
								<th> Inhoud </th>
								<th></th>
								<th colspan="3" class="col-md-1"> Acties </th>								
							</tr>
						</thead>
						
						<tbody>
						@foreach($pages as $page)
							<tr class="">
								<td> {!! $page->introduction->title	!!}</td>
								{{--*/ $phrase = trunc($page->introduction->text, 30); /*--}}
								<td colspan="2"> {!! $phrase !!}	</td>
								<td>
									<a href="{{ route('page.show', [$page->pageId]) }}">
										<i class="fa fa-external-link fa-lg"></i></a>
								</td>								
								<td>
									<a href="{{ route('page.edit', [$page->pageId]) }}">
										<i class="fa fa-pencil-square-o fa-lg"></i>
									</a>
								</td>
								<td>
									<a href="{{ route('page.del', [$page->pageId]) }}" onclick="verify()">
										<i class="fa fa-times fa-lg text-danger"></i></a>
								</td>						
							</tr>
						@endforeach
					</tbody>
					</table>
				</div>
			</div>		
		</div>

@endsection

@section('additional_scripts')
   {!! HTML::script('custom/js/main.js') !!}
@endsection
