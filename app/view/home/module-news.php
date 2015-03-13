
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4> 
				Nieuws
			</h4>
		</div>
		<div class="panel-body">
<<<<<<< HEAD
			<?php foreach($data as $newsItem){
                if($newsItem->getHidden() === false)
                {
                    echo '<a href="NewsController/show/'. $newsItem->getId() .'""><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a> '.
                        $newsItem->getNormalDate() .' - ' .$newsItem->getTitle() . '<br/>';
                }
=======
			<?php foreach($data['news'] as $newsItem){
				echo '<a href="NewsController/show/'. $newsItem->getId() .'"">			
				<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a> 
				'. $newsItem->getNormalDate() .' - ' .$newsItem->getTitle() .'<br/>';  
>>>>>>> develop
			} ?>
		</div>
	</div>


