<header>

</header>
<!-- Page Content -->
<?php require_once 'carousel.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
            <h2 class="page-header">De Bunders</h2>
        </div>
	</div>

    <!-- Features Section -->
    <div class="row">
        <div class="col-md-8">
			<?php
				for ($i = 0; $i < count($data['layoutmodules']) - 1; $i++) {
					require_once $data['layoutmodules'][$i]->getModulename() . '.php';
				}
			?>
		</div>
		<div class="col-md-4">
			<?php
				require_once $data['layoutmodules'][count($data['layoutmodules']) - 1]->getModulename() . '.php';
			?>
		</div>
