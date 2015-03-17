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
							<th class="cu-smallcol">		<!-- Article ID -->
								ID
							</th>
							<th>							<!-- Article title -->
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
							echo
								'<tr>
									<td>
										1
									</td>
									<td>
										<input type="text" name="artikel[0]" value="0" class="hiddenInput" />
										<span>0</span>
									</td>
									<td>
										Artikel hc
									</td>
									<td>';
          #If there are uploaded files

            if(isset($data['files']) && count($data['files']) > 0  && count($data['files']) < 2)
            {
                
                foreach($data['files'] as $file)
                {
                    echo '<p>' . $file->path .'</p>';
                }
                echo '<label for="keepFiles" class="control-label input-group">Wilt u dit bestanden behouden?</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" name="keepFiles" value="true" checked="true">Ja
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="keepFiles" value="false">Nee
                    </label>
                </div>
            </div>';
            }
            ?>

            
                <input  id="upload" type='file' name='file[]' multiple/> 
                </td>        
               <td> <a class="btn btn-danger btn-sm" id="cancel"> Verwijder bestand </a>
            



 <?php
							echo '		</td>
									<td>
										<a class="btn btn-primary btn-xs" onclick="moveArticleUp(this)"><i class="fa fa-arrow-up"></i></a>
									</td>
									<td>
										<a class="btn btn-primary btn-xs" onclick="moveArticleDown(this)"><i class="fa fa-arrow-down"></i></a>
									</td>
									<td>
										<a class="btn btn-danger btn-xs" onclick="removeArticle(this)"><i class="fa fa-times"></i></a>
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