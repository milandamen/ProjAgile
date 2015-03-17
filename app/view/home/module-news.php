<div class="panel panel-default dragdiv">							<!-- The dragdiv class is used in /Home/editlayour -->
	<input class="hiddenInput" type="text" name="module-news" />	<!-- This input gets sent in /Home/editlayout -->
	<div class="panel-heading">
		<h4> 
			Nieuws
			<?php if($data['loggedIn'] && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2))
            {
				echo '<a href="NewsController/create"><i class="fa fa-plus"></i></a>';
			}
            ?>
		</h4>
	</div>
    <div class="panel-body">
        <?php foreach($data['news'] as $newsItem){
            if($newsItem->getHidden() === false)
            {
                echo '<a href="NewsController/show/'. $newsItem->getId() .'""><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a> '.
                    $newsItem->getNormalDate() .' - ' .$newsItem->getTitle() . '<br/>';
            }
        } ?>
    </div>
</div>
