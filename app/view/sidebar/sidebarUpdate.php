<!-- Page Content -->
<div class="container">

	<div class="row">
		<div class="col-lg-12">
			<h1>Wijzig Sidebar </h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<form name="updateSidebar" id="updateSidebar" method="post" enctype="multipart/form-data" action="">
				<button type="button" class="btn btn-primary" onclick="goBack()">Annuleer</button>
				<button type="submit" class="btn btn-primary">Opslaan</button>
 				<button type="button" onclick="addRow()" class="btn btn-primary">Voeg rij toe</button>
                <hr>
                Koptekst: <input type="text" name="sidebar['title']" id="sidebarTitle" value="<?php echo $data['sidebarRows'][0]->getTitle(); ?>" required> <br/><br/>
                
                <?php 
                   echo '<table name="X" class="col-md-8">';
                foreach($data['sidebarRows'] as $sidebarRow)
                {
                	$rowCount = 1;
                	if($rowCount == 0)
                		{
                			echo '
                			<tr>
                				<td>Tekst: <input type="text" name="sidebar[' . $rowCount . '][text][]" id="sidebarText" value="' . $sidebarRow->getText() . '" required> </td>
                				<td>Tekst: <input type="text" name="sidebar[' . $rowCount . '][text][]" id="sidebarText" value="' . $sidebarRow->getText() . '" required> </td>
								<td><button type="button" onclick="removeRow(this)" class="btn btn-primary">X</button><td>
							<br/> </tr>';


						} else {

							if(null !== $sidebarRow->getInternLink()){
								$url = $sidebarRow->getInternLink();
							} else {
								$url = $sidebarRow->getExternLink();
							}

							echo '
                			<tr>
                				<td>Tekst: <input type="text" name="sidebar[' . $sidebarRow->getRowNr() . '][text][]" id="sidebarText" value="' . $sidebarRow->getText() . '" required> </td>
                				<td>Link: <input type="text" name="sidebar[' . $sidebarRow->getRowNr() . '][text][]" id="sidebarText" value="' . $url . '"> </td>
								<td><button type="button" onclick="removeRow(this)" class="btn btn-primary">X</button><td>
							<br/> </tr>';
						}
				}
				
?>	</table>
				<div id="success"></div>
			</form>
		</div>



