<div class="panel panel-default dragdiv">								<!-- The dragdiv class is used in /Home/editlayout -->
	<input class="hiddenInput" type="text" name="module-newonsite" />		<!-- This input gets sent in /Home/editlayout -->
	<div class="panel-heading">
		<h4> 
			Nieuw op de site			
		</h4>
	</div>
	<div class="panel-body">
		<ul class="">
            @foreach($newOnSite as $newOnSiteItem)
                <li class="sidebar">{{$newOnSiteItem->dateOnly()}} - {{$newOnSiteItem->message}}</li>
            @endforeach
		</ul>
	</div>
</div>