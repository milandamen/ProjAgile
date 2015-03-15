<div class="panel panel-default dragdiv">							<!-- The dragdiv class is used in /Home/editlayour -->
	<input class="hiddenInput" type="text" name="module-sidebar" />	<!-- This input gets sent in /Home/editlayout -->
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

				if(null !== $sidebarItem->getInternLink()) {
					echo' 
					<li><a href="'. $sidebarItem->getInternLink() 
					.'" class="">&gt; '
					. $sidebarItem->getText() 
					.'</a></li>
					';
				} else {
				echo' 
					<li><a href="'. $sidebarItem->getExternLink() 
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