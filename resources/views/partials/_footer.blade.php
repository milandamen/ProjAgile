<div class="container">
	<hr>
	<div class="col-md-12 footer panel panel-default">
		@for($c = 0; $c < count($footer); $c++)
			<div class="footerlist-container">
				<ul class="col-sm-4">
					@for($r = 0; $r < count($footer[$c]); $r++)
						@if($footer[$c][$r]->link != null)
							{{--*/ $link = $footer[$c][$r]->link; /*--}}
							 @if($r === 0)
								<li>
									<a href="{!! url($link) !!}"><h3>{{$footer[$c][$r]->text}}</h3></a>
								</li>
							 @else
								<li>
									<a href="{!! url($link) !!}">{{$footer[$c][$r]->text}}</a>
								</li>
							 @endif
						@else
							@if($r === 0)
								<li>
									<a href="#">
										<h3>{{$footer[$c][$r]->text}}</h3>
									</a>
								</li>
							@else
								<li>
									<a href="#">{{$footer[$c][$r]->text}}</a>
								</li>
							@endif
						@endif
					@endfor
				</ul>
			</div>
		@endfor
		<div class="footer-edit-link">
			@if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')
				<a href="{{route('footer.edit')}}">
					<i class="fa fa-pencil-square-o"></i>
				</a>
			@endif
		</div>
	</div>
</div>