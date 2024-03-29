<div class="col-md-4">
	<div class="panel panel-default dragdiv">							{{-- The dragdiv class is used in /Home/editlayour  --}}
		<input class="hiddenInput" type="text" name="module-sidebar"/>	{{-- This input gets sent in /Home/editlayout --}}
		<div class="panel-heading sidebar">
			<h4>
				{!! $sidebar[0]->title !!}
				@if(Auth::check() && (Auth::user()->usergroup->name === 'Administrator'  || Auth::user()->usergroup->name === 'Content Beheerder'))
					 <a class="right" href="{{ route('sidebar.edit', [$sidebar[0]->page_pageId]) }}">
						<i class="fa fa-pencil-square-o"></i>
					</a>
				@endif
			</h4>
		</div>
		<div class="panel-body">
			<ul>
				@foreach($sidebar as $sidebarItem)
					@if(!$sidebarItem->extern)
						<li class="sidebar">
							<a href="{!! url($sidebarItem->link) !!}" class="">
							&gt; {!! $sidebarItem->text !!}</a>
						</li>
					@else
						<li class="sidebar">
							<a href=" {!! url($sidebarItem->link) !!}" target="_blank" class="">&gt;
							{!! $sidebarItem->text!!} </a>
						</li>
					@endif
				@endforeach
			</ul>
		</div>
	</div>
</div>