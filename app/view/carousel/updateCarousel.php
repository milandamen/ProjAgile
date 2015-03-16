<!-- Page Content -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Wijzig carousel</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form id="updateSidebar" method="post" action="">
				<table id="articlelisttable" class="table">
					<thead>
						<tr>
							<th class="cu-smallcol">		<!-- Index -->
								Index
							</th>
							<th>							<!-- Article title -->
								Nieuws artikel
							</th>
							<th class="cu-smallcol">		<!-- Move up -->
							</th>
							<th class="cu-smallcol">		<!-- Move down -->
							</th>
							<th class="cu-smallcol">		<!-- Remove -->
							</th>
						</tr>
					</thead>
					<tbody id="articlelist">
						<?php
							echo
								'<tr>
									<td>
										1
									</td>
									<td>
										<input type="text" name="artikel[0]" class="hiddenInput" />
										Artikel 1
									</td>
									<td>
										<a href="#" class="btn btn-primary btn-xs" onclick=""><i class="fa fa-arrow-up"></i></a>
									</td>
									<td>
										<a href="#" class="btn btn-primary btn-xs" onclick=""><i class="fa fa-arrow-down"></i></a>
									</td>
									<td>
										<a href="#" class="btn btn-danger btn-xs" onclick=""><i class="fa fa-times"></i></a>
									</td>
								</tr>'
						?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-success">Opslaan</button>
				<button type="button" class="btn btn-danger" onclick="goBack()">Annuleer</button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>Zoek artikel op titel</h2>
			<input type="text" id="artikeltitel" />
			<a href="#" onclick="" class="btn btn-primary">Zoek</a>
		</div>
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>
							Nieuws artikel
						</th>
					</tr>
				</thead>
				<tbody id="searchresults">
					
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
	
	<!-- JavaScript file that handles removing and adding of rows and posting of the data form -->
	<script src="/ProjAgile/public/js/carouselUpdate.js"></script>