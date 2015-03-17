<!-- Page Content -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Wijzig carousel</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form id="updateSidebar" method="post" action="" enctype="multipart/form-data">
				<table id="articlelisttable" class="table">
					<thead>
						<tr>
							<th class="cu-smallcol">		<!-- Index -->
								Index
							</th>
							<th class="cu-smallcol">		<!-- Article ID -->
								ID
							</th>
							<th style="width: 100%";>		<!-- Article title -->
								Nieuws artikel
							</th>
							<th>
								Image
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
							// PLACEHOLDER INFORMATION: REPLACE WITH DATABASE INFORMATION!
							// echo
							// 	'<tr>
							// 		<td>
							// 			1
							// 		</td>
							// 		<td>
							// 			<input type="text" name="artikel[0]" value="0" class="hiddenInput" />
							// 			<span>0</span>
							// 		</td>
							// 		<td>
							// 			Artikel hc
							// 		</td>
							// 		<td>
							// 			<input type="file" name="file[0]" /> 
							// 		</td>
							// 		<td>
							// 			<a class="btn btn-primary btn-xs" onclick="moveArticleUp(this)"><i class="fa fa-arrow-up"></i></a>
							// 		</td>
							// 		<td>
							// 			<a class="btn btn-primary btn-xs" onclick="moveArticleDown(this)"><i class="fa fa-arrow-down"></i></a>
							// 		</td>
							// 		<td>
							// 			<a class="btn btn-danger btn-xs" onclick="removeArticle(this)"><i class="fa fa-times"></i></a>
							// 		</td>
							// 	</tr>';
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
			<a onclick="searchArticle()" class="btn btn-primary">Zoek</a>
		</div>
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th class="cu-smallcol">
							ID
						</th>
						<th>
							Titel
						</th>
						<th class="cu-smallcol">
							
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