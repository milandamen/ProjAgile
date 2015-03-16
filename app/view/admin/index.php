<!-- Page Content -->
<div class="container">

<!----

	Group ID and name.
	ID 1 = admin
	ID 2 = contentbeheerder
	ID 3 = user
	ID 4 = testgroup

--->
    <!-- Features Section -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Beheer</h2>
           	<p> Op deze pagina zijn alle elementen te vinden die men kan beheren. 
           		Afhankelijk van de groep waarin de beheerder zit zijn er diverse functies afgeschermd of juist niet. </p>

           	<?php 

           	if($_SESSION['userGroupId'] == 1){ // All full-admin functionality
           		// layout wisselen homepage
           		// user rechten wijzigen 
           		// footer wijzigen
           		// sidebar wijzigen
           		// carrousel wijzigen
           		// 

           		echo '<div> 
           				<table>
           					<th>Layout</th>
           					<tr><a href =""> Layout homepage wijzigen </a></tr>
           					<tr><a href =""> Sidebar wijzigen </a></tr>
           					<tr><a href =""> Menu wijzigen </a></tr>
           					<tr><a href ="">  </a></tr>
           				</table>
           		</div>';

           	} else if($_SESSION['userGroupId'] == 2) {	// All content-admin functionality
           		// plaatsen en of wijzigen van nieuws berichten 
           		// plaatsen en of wijzigen van project 
           		// plaatsen en of wijzigen van activiteiten
           		// wijzigen 'over ons', wijkraad pagina's en contact

           	}
           	?>



        
        </div>
  