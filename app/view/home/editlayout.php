<div class="container">
	<form id="dataform">
		<div id="draggabledivs" class="row">
			<div class="col-md-8">
				<?php require 'module-news.php'; ?>
				<?php require 'module-news.php'; ?>
			</div>
			
			<div class="col-md-4">
				<div class="dragdiv">
					sidebar
					<input class="hiddenInput" type="text" name="sidebar" />
				</div>
			</div>
		</div>
	</form>
	<div>
		<a href="#" onclick="submitLayoutForm()">Submit Form</a>
	</div>
	
	<!-- JavaScript that enables dragging and dropping and sends form -->
	<script src="/ProjAgile/public/js/editlayout.js"></script>