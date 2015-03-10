
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Wijzig Footer</h1>
            <button type="button" class="btn btn-primary" onclick="goBack()">Annuleer</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form name="updateFooter" id="updateFooter" method="post" enctype="multipart/form-data" action="">
                <button type="submit" class="btn btn-primary">Sla op</button>
                <hr>
                <button type="button" onclick="addColumn()" class="btn btn-primary">Voeg kolom toe</button>
                <hr>
                <div id="footer-tables" class="footer-tables">
                    <?php
                    $colCount = 0;
                    foreach($data['footerColumns'] as $footercolumn)
                    {
                        $rowCount = 0;
                        echo '<table name="'. $colCount .'" class="col-sm-4">';
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
                             <button type="button" onclick="removeRow(this)" class="btn btn-primary">X</button>
                             <br/> Link: <input type="text" name="footer[' . $colCount . '][link][]" id="footerLink" value="' . $item->getLink() . '">
                             </td></tr>';
                            }
                            else
                            {
                                echo '<tr><td>Text: <input type="text" name="footer[' . $colCount . '][text][]" id="footerText" value="' . $item->getText() . '" required>
                             <button type="button" onclick="removeRow(this)" class="btn btn-primary">X</button>
                             <br/> Link: <input type="text" name="footer[' . $colCount . '][link][]" id="footerLink" value="' . $item->getLink() . '">
                             </td></tr>';
                            }
                            $rowCount++;
                        }
                        echo '<tr><td><button type="button" onclick="addRow(this)" class="btn btn-primary">Voeg link toe</button></td></tr>
                            <tr><td><button type="button" onclick="removeColumn(this)" class="btn btn-primary">Verwijder kolom</button></td></tr>
                            </table>';
                        $colCount++;
                    }
                    ?>
                </div>
                <div id="success"></div>
            </form>
        </div>
    </div>
    <!-- JavaScript that enables adding and removing columns and rows -->
    <script src="/ProjAgile/public/js/footerUpdate.js"></script>