@extends('app')

@section('title')
	De Bunders - Pagina's Wijzigen
@stop

@section('description')
	Dit is de beveiligde pagina's overzicht pagina van De Bunders.
@stop

@section('content')
	 <div class="container">
		<div class="row">
			{!! Breadcrumbs::render('page.index') !!}
		</div>
		<div class="row">	
			<div class="col-md-12">
				<h2 class="page-header">
					Pagina Overzicht
				</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-md-12">
				 <p class="col-md-8"> 
					Deze pagina is enkel zichtbaar voor de administrator en toont 
					alle pagina's. 
				</p>
				{!! link_to_route('page.create', 'Nieuwe Pagina', [], ['class' => 'btn btn-success white ']) !!}
				{!! link_to_route('management.index', 'Terug naar Beheer', [], ['class' => 'btn btn-danger white addright addmargin']) !!}
			</div>
			<div class="col-md-10 addmargin">
				<table class="table borderless">
					<thead> 
						<tr>
							<th></th>
							<th colspan="2">Titel</th>
							<th>Subtitel</th>
							<th></th>
							<th colspan="3" class="col-md-1">Acties</th>
						</tr>
					</thead>
					<tbody>
						{{--*/ $date = date('d-m-Y H:i',time()-(7*86400)); // 7 days ago
								$curDate = date('d-m-Y H:i', time()); /*--}}
						@foreach($pages as $page)
						{{--*/ $hasChildren = false; 
							$parentItem = false; /*--}}
							@if($page->parentId == 0)

								<tr>
									<td>
										@if($page->publishEndDate < $date)
											<i class="fa fa-archive fa-lg"></i>
										@elseif($page->publishEndDate < $curDate) 
											<i class="fa fa-ban fa-lg" alt=""></i>
										@elseif($page->publishDate > $curDate)
											<i class="fa fa-clock-o fa-lg" alt="scheduled" title="scheduled"></i>
										@endif
									</td>	
									
									<td colspan="2">{!!  $page->introduction->title !!}</td>
									<td>{!! $page->introduction->subtitle !!} </td>
									@if($page->sidebar)
										<td>
											<a href="{{ route('sidebar.edit', [$page->pageId]) }}">Wijzig Sidebar</a>
										</td>
									@else 
										<td></td>
									@endif
									<td>
										<a href="{{ route('page.show', [$page->pageId]) }}">
											<i class="fa fa-external-link fa-lg"></i>
										</a>
									</td>
									<td>
										<a href="{{ route('page.edit', [$page->pageId]) }}">
											<i class="fa fa-pencil-square-o fa-lg"></i>
										</a>
									</td>
									<td>
										@if($page->visible)
											<i class="fa fa-eye fa-lg"></i>
										@else
											<i class="fa fa-eye-slash fa-lg"></i>
										@endif
									</td>
									<td>
										<!-- Check if page has childs or not. If page has childs delete button will not be shown  -->
										@foreach($pages as $subpage)
											@if($subpage->parentId == $page->pageId)
												{{--*/ $hasChildren = true; /*--}}
											@endif
										@endforeach
										@if(!$hasChildren)
										<a href="{{ route('page.destroy', [$page->pageId]) }}" onclick="confirmDelete()">
											<i class="fa fa-times fa-lg text-danger"></i>
										</a>
										@endif
									</td>
								</tr>

								<!--  When parent is shown, check for subpages again but this time also show them -->
								@foreach($pages as $subpage)
									@if($subpage->parentId == $page->pageId)
										<tr>
											<td>
												@if($subpage->publishEndDate < $date)
													<i class="fa fa-archive fa-lg"></i>
												@elseif($subpage->publishEndDate < $curDate) 
													<i class="fa fa-ban fa-lg"></i>
												@elseif($subpage->publishDate > $curDate)
													<i class="fa fa-clock-o fa-lg"></i>
												@endif
											</td>
											<td></td>	
											<td>{!! $subpage->introduction->title !!}</td>
											<td>{!! $subpage->introduction->subtitle !!} </td>
											@if($subpage->sidebar)
												<td>
													<a href="{{ route('sidebar.edit', [$subpage->pageId]) }}">Wijzig Sidebar</a>
												</td>
											@else 
												<td></td>
											@endif
											<td>
												<a href="{{ route('page.show', [$subpage->pageId]) }}">
													<i class="fa fa-external-link fa-lg"></i>
												</a>
											</td>
											<td>
												<a href="{{ route('page.edit', [$subpage->pageId]) }}">
													<i class="fa fa-pencil-square-o fa-lg"></i>
												</a>
											</td>
											<td>
												@if($subpage->visible)
													<i class="fa fa-eye fa-lg"></i>
												@else
													<i class="fa fa-eye-slash fa-lg"></i>
												@endif
											</td>
											<td>
												<a href="{{ route('page.destroy', [$subpage->pageId]) }}" onclick="confirmDelete()">
													<i class="fa fa-times fa-lg text-danger"></i>
												</a>
											</td>
										</tr>
									@endif
								@endforeach
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>		
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop