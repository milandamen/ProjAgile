<div class="container">
	<form id="dataform" method="post">
		<div id="draggabledivs" class="row">
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
		</div>
	</form>
	<div>
		<a href="#" class="btn btn-success" onclick="submitLayoutForm()">Opslaan</a>
	</div>
	
	<!-- JavaScript that enables dragging and dropping and sends form -->
	<script src="/ProjAgile/public/js/editlayout.js"></script>
	
	<div class="row">