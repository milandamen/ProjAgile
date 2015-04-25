<div class="introduction dragdiv">											<!-- The dragdiv class is used in /Home/editlayout -->
	<input class="hiddenInput" type="text" name="module-introduction" />	<!-- This input gets sent in /Home/editlayout -->
	
	<div>
		<h4> 
			@if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')	
				<a href="{{ route('home.editIntroduction')}}"><i class="fa fa-pencil-square-o"></i></a>
			@endif
                {!! $introduction->title  !!}
		</h4>
	</div>
	<div class="panel-body">
		{!! nl2br($introduction->text) !!}
	</div>
</div>