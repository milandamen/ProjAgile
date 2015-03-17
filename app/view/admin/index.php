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
            <div class="col-md-8">
           	<p> Op deze pagina zijn alle elementen te vinden die men kan beheren. 
           		U heeft toegang tot alle onderdelen die hieronder te vinden zijn. Mocht u een onderdeel missen meld dit dan bij de beheerder! 

           		</p>
           	<?php 

           	if($data['loggedIn'] && $_SESSION['userGroupId'] == 1){ // All full-admin functionality
           		echo '<div class="col-md-4"> 
	           			<h3>Layout modules</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="/ProJAgile/public/Home/editlayout" role="button">Homepage layout </a>
								<a class="btn btn-default" href="#" role="button">Carrousel wijzigen</a>
								<a class="btn btn-default" href="/ProJAgile/public/sidebarController/sidebarUpdate/1" role="button">Sidebar Home wijzigen</a>
								<a class="btn btn-default" href="#" role="button">Menu wijzigen</a>
								<a class="btn btn-default" href="/ProJAgile/public/FooterController/footerUpdate" role="button">Footer wijzigen</a>
	           				</div>
           				</div>
           				<div class="col-md-4">
	           				<h3>Content wijzigen</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="/ProJAgile/public/NewsController/create" role="button">Nieuws toevoegen</a>
	           					<a class="btn btn-default" href="#" role="button">Introductie wijzigen</a>
	           				</div>
           				</div>

           				<div class="col-md-4">
	           				<h3>Gebruikers beheer</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="#" role="button">Content beheerders</a>
	           					<a class="btn btn-default" href="#" role="button">Administrators</a>
	           					<a class="btn btn-default" href="#" role="button">Deelwijken</a>
	           				</div>
	           			</div>';

           	} else if($data['loggedIn'] && $_SESSION['userGroupId'] == 2) {	// All content-admin functionality
           		echo '<div class="col-md-4"> 
	           			<h3>Layout modules</h3>
	           			<div class="btn-group-vertical">
								<a class="btn btn-default" href="#" role="button">Carrousel wijzigen</a>
								<a class="btn btn-default" href="/ProJAgile/public/sidebarController/sidebarUpdate/1" role="button">Sidebar Home wijzigen</a>
	           			</div>
           			</div>
           			<div class="col-md-4">
	           			<h3>Content wijzigen</h3>
	           			<div class="btn-group-vertical">
	           				<a class="btn btn-default" href="/ProJAgile/public/NewsController/create" role="button">Nieuws toevoegen</a>
	           				<a class="btn btn-default" href="#" role="button">Introductie wijzigen</a>
	          				</div>
           			</div>';
           	}
           	?>

           </div> 
        </div>
  