<!-- Page Content -->
<div class="container">

	<div class="row">
		<div class="col-lg-12">
			<h1>Wijzig Sidebar </h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<!--- Start Form of updating the sidebar -->
			<form name="updateSidebar" id="updateSidebar" method="post" enctype="multipart/form-data" action=""> 			
				<input type="text" name="maxRowIndex" id="maxRowIndex" class="hiddenInput" />
				
                <hr>
                Koptekst: <input type="text" name="title" id="sidebarTitle" value="<?php echo $data['sidebarRows'][0]->getTitle(); ?>" required> <br/><br/>
                
                <?php 
                // Add new row-button
					echo 
					'<table name="X" id="sidebarTable" class="col-md-12">
						<tr>
							<td>
								<button type="button" onclick="addSideRow(this)" class="btn btn-warning">Voeg rij toe</button>
							</td>
						</tr>';


				// Loop through all fields and make editable. 			
				$i=0;	
                foreach($data['sidebarRows'] as $sidebarRow)
                {

                			// Check if link goes out or stays in. 
							if(null !== $sidebarRow->getInternLink()){
								$url = $sidebarRow->getInternLink();
							} else {
								$url = $sidebarRow->getExternLink();
							}

							echo 
								'<tr>
									<td class="td-tekst">Tekst: <input type="text" name="sidebar[' . $i . '][text][]" id="sidebarText" value="' . $sidebarRow->getText() . '" required> </td>
									<td class="td-link" >Link: <input type="text" name="sidebar[' . $i . '][link][]" id="sidebarLink" value="' . $url . '"> </td>
							'; ?>
							<!--- Make decision for intern or extern link -->
							<td class="td-radio1">
								<?php if(null !== $sidebarRow->getInternLink()) {
									echo '
								<div class="radio">
  									<label class="radio-inline"><input type="radio"  name="sidebar['.$i.'][radio1]" value="Extern">Extern</label>
									<label class="radio-inline active"><input type="radio"  name="sidebar['.$i.'][radio1]" value="Intern" checked="">Intern</label>
								</div> ';
								 } else { 
									echo '<div class="radio">
  									<label class="radio-inline"><input type="radio" name="sidebar['.$i.'][radio1]" value="Extern" checked="">Extern</label>
									<label class="radio-inline active"><input type="radio" name="sidebar['.$i.'][radio1]" value="Intern">Intern</label>
								</div>
								';
								 }	?>	
							</td>
							<?php
							 // Row removal button 
							echo '<td><button type="text" onclick="removeSideRow(this)" class="btn btn-danger btn-xs">X</button></td> </tr>';
						$i++;		
				} ?> 				
					</table>
				<div id="success"></div>
				<button type="button" class="btn btn-danger" onclick="goBack()">Annuleer</button>
				<button type="submit" class="btn btn-success">Opslaan</button>
			</form>

			

		</div>
 <!-- JavaScript that enables adding and removing rows -->
    <script src="/ProjAgile/public/js/sidebar.js"></script>


