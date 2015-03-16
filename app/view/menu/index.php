<div class="container">
<div id="row">

<?php
$allMenuData = $data['allMenuData'];

?>
<div class="table-responsive">
    <table class="table">
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
                echo("<Form>");
                foreach($allMenuData as $menuItem)
                {
                    echo("
                        <tr>
                            <td>" . $menuItem->getMenuId(). "</td>
                            <td><input type='text' value='" . $menuItem->getName(). "'></td>
                            <td><input type='text' value='" . $menuItem->getRelativeUrl(). "'></td>
                    ");

                    if($menuItem->getParentId() == null)
                    {
                        echo("
                            <td><input type='text' value='" . $menuItem->getMenuOrder() . "'></td>
                        ");
                    }
                    else
                    {
                        echo("
                            <td><input type='text' value='" . $menuItem->getParentId() . '.' . $menuItem->getMenuOrder() . "'></td>
                        ");
                    }
                    if($menuItem->getPublish() == 1)
                    {
                        echo("
                                <td><input type='checkbox' checked></td>
                            </tr>
                        ");
                    }
                    else
                    {
                        echo("
                                <td><input type='checkbox'></td>
                            </tr>
                        ");
                    }
                }
                echo("</Form>");
            ?>
        </tbody>
    </table>
    <?php
        echo('<button type="button" style="float:right" class="btn btn-default">Opslaan</button>');
    ?>
</div>
</table>