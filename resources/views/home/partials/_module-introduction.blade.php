<div class="introduction dragdiv">											<!-- The dragdiv class is used in /Home/editlayour -->
	<input class="hiddenInput" type="text" name="module-introduction" />	<!-- This input gets sent in /Home/editlayout -->
	<div>
		<h4> 
			<!-- @\if(Auth:check)-->	
			<a href="{{ route('home.editIntroduction')}}"> Wijzig<i class="fa fa-pencil-square-o"></i></a>
			<!-- @\endif -->
           
			{!! $introduction->title  !!}
		</h4>
	</div>
	<div class="panel-body">
		{!! $introduction->text !!}
	</div>
</div>