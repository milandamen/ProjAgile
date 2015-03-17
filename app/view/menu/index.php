<div class="container">
<div id="row">

<?php
$allMenuData = $data['allMenuData'];

?>
<div class="table-responsive">
    <table class="table" id="menuTable">
        <thead>
        <tr>
            <th data-field="id">#</th>
            <th data-field="name">Menu-item naam</th>
            <th data-field="url">pad naam</th>
            <th data-field="menuOrder">Menu level</th>
            <th data-field="publish">Tonen op site</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            echo("
                    <form name='updateMenu' id='updateMenu' method='post' action='' enctype='multipart/form-data'>
                    <input type='text' name='maxRowIndex' id='maxRowIndex' class='hiddenInput' />
                ");

                foreach($allMenuData as $menuItem)
                {
                    echo('
                        <tr>
                            <td>' . $menuItem->getMenuId(). '</td>
                            <td><input type="text" name="menuItem[' . $i . '][]" value="' . $menuItem->getName(). '"></td>
                            <td><input type="text" name="menuURL[' . $i . '][]" value="' . $menuItem->getRelativeUrl(). '"></td>
                    ');

                    if($menuItem->getParentId() == null)
                    {
                        echo('
                            <td><input type="text" name="menuOrder[' . $i . '][]" value="' . $menuItem->getMenuOrder() . '"></td>
                        ');
                    }
                    else
                    {
                        echo('
                            <td><input type="text" name="menuLevel[' . $i . '][]" value="' . $menuItem->getParentId() . '.' . $menuItem->getMenuOrder() . '"></td>
                        ');
                    }
                    if($menuItem->getPublish() == 1)
                    {
                        echo('
                                <td><input type="checkbox" name="menuPublic[' . $i . '][]" checked></td>
                            </tr>
                        ');
                    }
                    else
                    {
                        echo("
                                <td><input type='checkbox'></td>
                            </tr>
                        ");
                    }
                    $i++;
                }
                echo '</tbody>';
                echo '</table>';
                echo('<button type="submit" class="btn btn-default" style="float:right">Opslaan</button>');
                echo("</form>");
            ?>

</div>
</table>

    <!-- JavaScript that enables adding and removing rows -->
    <script src="/ProjAgile/public/js/menu.js"></script>