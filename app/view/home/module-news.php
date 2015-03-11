<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4> 
				<a href="#"><i class="fa fa-pencil-square-o"></i></a>
				Nieuws
			</h4>
		</div>
		<div class="panel-body">
			<?php foreach($data as $newsItem){
				echo '<a href="NewsController/show/'. $newsItem->getId() .'""><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a> '. 
				$newsItem->getNormalDate() .' - ' .$newsItem->getTitle() . '<br/>';  
			} ?>
		</div>
	</div>
</div>

