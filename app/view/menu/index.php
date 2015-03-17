<div class="container">
<div id="row">

<?php
$allMenuData = $data['allMenuData'];

?>
<div class="table-responsive">
    <form name='updateMenu' id='updateMenu' method='post' action='' enctype='multipart/form-data'>
        <table class="table" id="menuTable">
            <thead>
                <tr>
                    <th data-field="id">#</th>
                    <th data-field="name">Menu-item naam</th>
                    <th data-field="url">pad naam</th>
                    <th data-field="menuOrder">Menu level</th>
                    <th data-field="publish">Tonen op site</th>
                    <th data-field="delete"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    echo("<input type='text' name='maxRowIndex' id='maxRowIndex' value='". (count($allMenuData)-1). "' class='hiddenInput' />");

                    foreach($allMenuData as $menuItem)
                    {
                        echo('
                            <tr>
                                <td><input type="text" name="menuItem[' . $i . '][0]" id="id" style="display:none;" value="' . $menuItem->getMenuId(). '">'.  $menuItem->getMenuId() .' </td>
                                <td><input type="text" name="menuItem[' . $i . '][1]" id="item" value="' . $menuItem->getName(). '"></td>
                                <td><input type="text" name="menuItem[' . $i . '][2]" id="url" value="' . $menuItem->getRelativeUrl(). '"></td>
                        ');

                        if($menuItem->getParentId() == null)
                        {
                            echo('
                                <td><input type="text" name="menuItem[' . $i . '][3]" id="lvl" value="' . $menuItem->getMenuOrder() . '"></td>
                            ');
                        }
                        else
                        {
                            echo('
                                <td><input type="text" name="menuItem[' . $i . '][3]" id="lvl" value="' . $menuItem->getParentId() . '.' . $menuItem->getMenuOrder() . '"></td>
                            ');
                        }
                        if($menuItem->getPublish() == 1)
                        {
                            echo('
                                    <td><input type="checkbox" name="menuItem[' . $i . '][4]" checked></td>

                            ');
                        }
                        else
                        {
                            echo('
                                    <td><input type="checkbox" name="menuItem[' . $i . '][4]" id="public" ></td>

                            ');
                        }
                        echo '<td><a onclick="removeMenuRow(this)" class="btn btn-danger btn-xs">X</a></td> </tr>';
                        $i++;
                    }
                ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-default" style="float:right">Opslaan</button><button type="button" onclick="addMenuRow(this)" class="btn btn-warning" style="float:right">Voeg rij toe</button>
    </form>
</div>
<!-- JavaScript that enables adding and removing rows -->
<script src="/ProjAgile/public/js/menu.js"></script>