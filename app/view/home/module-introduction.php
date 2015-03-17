<div class="introduction dragdiv">											<!-- The dragdiv class is used in /Home/editlayour -->
	<input class="hiddenInput" type="text" name="module-introduction" />	<!-- This input gets sent in /Home/editlayout -->
	<div>
		<h4> 
			<?php if($data['loggedIn'] && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2))
            {
				echo '<a href="Home/editIntro"><i class="fa fa-pencil-square-o"></i></a>';
			}
            ?>
			 <?php echo $data['intro']->getTitle()  ?>
		</h4>
	</div>
	<div class="panel-body">
		<?php echo $data['intro']->getText(); ?>
	</div>
</div>