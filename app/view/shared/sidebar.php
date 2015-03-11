<div class="col-md-4" id="navigationbar-right">
	<div class="panel panel-default">
		<div class="panel-heading sidebar">
    		<h4>Meer informatie? <a class="right" href="#"><i class="fa fa-pencil-square-o"></i></a></h4>
    	</div>
    	<div class="panel-body">
			<ul>
			<?php 
				foreach($data['sidebarRows'] as $sidebarItem){
					echo '
						<li><a href="'. $sidebarItem->getLink() 
						.'" class="">&gt; '
						. $sidebarItem->getText() 
						.'</a></li>
						';
					} ?>
			</ul>
		</div>
	</div>
</div>
