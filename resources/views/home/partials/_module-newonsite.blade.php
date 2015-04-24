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
                <li class="sidebar">{{$newOnSiteItem->created_at}} - {{$newOnSiteItem->message}}</li>
            @endforeach
			<li class="sidebar"> 13-04-2015 - Nieuws overzicht toegevoegd</li>
			<li class="sidebar"> 12-04-2015 - Inloggen </li>
			<li class="sidebar"> 11-04-2015 - Introductie toegevoegd </li>
			<li class="sidebar"> 11-04-2015 - Nieuws module toegevoegd</li>
		</ul>
	</div>
</div>