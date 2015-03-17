
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>Wijzig Footer</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<form name="updateFooter" id="updateFooter" method="post" enctype="multipart/form-data" action="">
				<button type="button" onclick="addColumn()" class="btn btn-primary">Voeg kolom toe</button>
				<hr/>
				<div id="footer-tables" class="footer-tables">
				<?php
					$colCount = 0;
					foreach($data['footerColumns'] as $footercolumn)
					{
						$rowCount = 0;
						echo '<table name="'. $colCount .'" class="col-sm-4">';

						echo '<tr><td><button type="button" onclick="addRow(this)" class="btn btn-primary btn-sm">Voeg link toe</button> 
						<button type="button" onclick="removeColumn(this)" class="btn btn-primary btn-sm">Verwijder kolom</button></td></tr>
						<tr><td> &nbsp;</td></tr>
						';

					

						foreach($footercolumn as $item)
						{
							$link = '#';
							if($item->getLink() != null)
							{
								$link = $item->getLink();
							}
							// first row has title, not text
							if($rowCount == 0)
							{
								echo '<tr><td>Titel: <input type="text" name="footer[' . $colCount . '][text][]" id="footerText" value="' . $item->getText() . '" required>
								<button type="button" onclick="removeRow(this)" class="btn btn-primary btn-xs">X</button>
								<br/> Link: <input type="text" name="footer[' . $colCount . '][link][]" id="footerLink" value="' . $item->getLink() . '">
								</td></tr>';
							} else {
								echo '<tr><td>Text: <input type="text" name="footer[' . $colCount . '][text][]" id="footerText" value="' . $item->getText() . '" required>
								<button type="button" onclick="removeRow(this)" class="btn btn-primary btn-xs">X</button>
								<br/> Link: <input type="text" name="footer[' . $colCount . '][link][]" id="footerLink" value="' . $item->getLink() . '">
								</td></tr>';
							}
							
							$rowCount++;
						}
				?> </table> <?php
					$colCount++;
					}
					?>
				</div>
				<div id="success" class="col-lg-12">
					<br/>
					<button type="button" class="btn btn-danger" onclick="goBack()">Annuleren</button> 
					<button type="submit" class="btn btn-success">Opslaan</button>	
				</div>	
				
			</form>

		</div>

<!-- JavaScript that enables adding and removing columns and rows -->
<script src="/ProjAgile/public/js/footerUpdate.js"></script>