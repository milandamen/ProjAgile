<div class="introduction dragdiv">											<!-- The dragdiv class is used in /Home/editlayour -->
	<input class="hiddenInput" type="text" name="module-introduction" />	<!-- This input gets sent in /Home/editlayout -->
	<div>
		<h4> 
			<?php if($data['loggedIn'] && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2))
            {
				echo '<a href="#"><i class="fa fa-pencil-square-o"></i></a>';
			}
            ?>
			Welkom op Wijkplatform De Bunders 
		</h4>
	</div>
	<div class="panel-body">
		De plek waar u actuele informatie of achtergronden kunt vinden over het wel en wee van de wijk De Bunders in Veghel, NB.
		In deze site is opgenomen wijkraaddebunders en kijkinmijnwijk
	</div>
</div>