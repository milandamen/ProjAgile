
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
                <div>
                    <?php
                    $colCount = 0;
                    foreach($data['footerColumns'] as $footercolumn)
                    {
                        $rowCount = 0;
                        echo '<ul class="col-sm-4">';
                        foreach($footercolumn as $item)
                        {
                            $link = '#';
                            if($item->getLink() != null){
                                $link = $item->getLink();
                            }
                            echo '<li><input type="hidden" name="footer[col][]" id="footerCol" value="' . $colCount . '">
                             <input type="hidden" name="footer[row][]" id="footerRow" value="' . $rowCount . '">
                             Text: <input type="text" name="footer[text][]" id="footerText" value="' . $item->getText() . '">
                             Link: <input type="text" name="footer[link][]" id="footerLink" value="' . $item->getLink() . '">
                             <button type="button" onclick="removeRow(this)">X</button></li>';
                            $rowCount++;
                        }
                        echo '</ul>';
                        $colCount++;
                    }
                    ?>
                </div>
                <div id="success"></div>
            </form>
        </div>
    </div>


<script>
    function addColumn()
    {

    }

    function removeColumn(column)
    {

    }

    function addRow(column)
    {

    }

    function removeRow(row)
    {
        var p=row.parentNode;
        p.parentNode.removeChild(p);
    }


    function goBack() {
        window.history.back()
    }
</script>