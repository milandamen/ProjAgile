<div class="container">
	<form id="dataform">
		<div id="draggabledivs" class="row">
			<div class="col-md-8">
				<div class="dragdiv" draggable="true">
					carrousel
					<input class="hiddenInput" type="text" name="carrousel" />
				</div>
				<div class="dragdiv" draggable="true">
					news
					<input class="hiddenInput" type="text" name="news" />
				</div>
			</div>
			<div class="col-md-4">
				<div class="dragdiv" draggable="true">
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