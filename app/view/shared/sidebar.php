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
			<!--- if link is intern, display link in same page. If link is extern display link in new screen -->
				<?php 
				foreach($data['sidebarRows'] as $sidebarItem){

					if(null !== $sidebarItem->getInternLink()) {
						echo' 
						<li class="sidebar"><a href="'. $sidebarItem->getInternLink() 
						.'" class="">&gt; '
						. $sidebarItem->getText() 
						.'</a></li>
						';
					} else {
					echo' 
						<li class="sidebar"><a href="'. $sidebarItem->getExternLink() 
						.'" target="_blank" class="">&gt; '
						. $sidebarItem->getText() 
						.'</a></li>
						';
					}
				}
			?>
			</ul>
		</div>
	</div>
</div>
