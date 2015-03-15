<div class="col-md-4" id="navigationbar-right">
	<div class="panel panel-default">
		<div class="panel-heading sidebar">
    		<h4> <?php echo $data['sidebarRows'][0]->getTitle(); ?> 
    			<?php if($data['logged']){
    				echo ' <a class="right" href="sidebarController/sidebarUpdate/'.$data['sidebarRows'][0]->getPageNr().'"><i class="fa fa-pencil-square-o"></i></a>';
    			} ?>
			</h4>
    	</div>
    	<div class="panel-body">
			<ul>
			<?php 
				foreach($data['sidebarRows'] as $sidebarItem){
					echo' 
						<li><a href="'. $sidebarItem->getInternLink() 
						.'" class="">&gt; '
						. $sidebarItem->getText() 
						.'</a></li>
						';
					} ?>
			</ul>
		</div>
	</div>
</div>
