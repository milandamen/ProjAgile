<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/ProjAgile/public/">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php

                $menuData = $data['menuData'];

                foreach($menuData as $menuItem)
                {
                    if($menuItem->getParentId() == null)
                    {
                        //TODO add base url to path if not done => wijkraad/wijkraad/wijkraad/deelwijk/a
                        $hasChildren = false;
                        $hasGrandChildren = false;
                        $parentItemCreated = false;
                        foreach($menuData as $subMenuItem)
                        {
                            //Does this menuItem has children?
                            if($subMenuItem->getParentId() == $menuItem->getMenuId())
                            {
                                $hasChildren = true;
                                //If UL created
                                if($parentItemCreated)
                                {
                                    echo('<li><a href="/ProjAgile/Public/' . $menuItem->getRelativeUrL() . '/' . $subMenuItem->getRelativeUrl() . '">'. $subMenuItem->getName() . '</a></li>');
                                }
                                else
                                {
                                    $parentItemCreated = true;

                                    echo('<li>');
                                    echo(' <a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. $menuItem->getName() . '<span class="caret"></span></a>');
                                    echo('<ul class="dropdown-menu" role="menu">');

                                    foreach($menuData as $subSubMenuItem)
                                    {
                                        if($subSubMenuItem->getParentId() == $subMenuItem->getMenuId())
                                        {
                                            $hasGrandChildren = true;
                                            //TODO: voeg subsubItem toe volgens Leons css
                                        }
                                    }
                                    echo('<li><a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '/' . $subMenuItem->getRelativeUrl() . '">'. $subMenuItem->getName() . '</a></li>');
                                }

                            }
                        }
                        if($hasChildren)
                        {
                            echo('</ul></li>');
                        }
                        else
                        {
                            echo('<li>');
                            echo('<a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '">' . $menuItem->getName() . '</a>');
                            echo('</li>');
                        }
                    }
                }



                    /*
                    $menuData = $data['menuData'];

                    foreach($menuData as $menuItem)
                    {
                        if($menuItem->getParentId() == null)
                        {
                            //TODO add base url to path if not done => wijkraad/wijkraad/wijkraad/deelwijk/a
                            $hasChildren = false;
                            $parentItemCreated = false;
                            foreach($menuData as $subMenuItem)
                            {
                                //Does this menuItem has children?
                                if($subMenuItem->getParentId() == $menuItem->getMenuId())
                                {
                                    //TODO add subsubMenuItem
                                    $hasChildren = true;
                                    //If UL created
                                    if($parentItemCreated)
                                    {
                                        echo('<li><a href="/ProjAgile/Public/' . $menuItem->getRelativeUrL() . '/' . $subMenuItem->getRelativeUrl() . '">'. $subMenuItem->getName() . '</a></li>');
                                    }
                                    else
                                    {
                                        $parentItemCreated = true;
                                        echo('<li>');
                                        echo(' <a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. $menuItem->getName() . '<span class="caret"></span></a>');
                                        echo('<ul class="dropdown-menu" role="menu">');
                                        echo('<li><a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '/' . $subMenuItem->getRelativeUrl() . '">'. $subMenuItem->getName() . '</a></li>');
                                    }

                                }
                            }
                            if($hasChildren)
                            {
                                echo('</ul></li>');
                            }
                            else
                            {
                                echo('<li>');
                                echo('<a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '">' . $menuItem->getName() . '</a>');
                                echo('</li>');
                            }
                        }
                    }*/


                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<!-- Navigation -->
    <!--<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <!--<div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/ProjAgile/public/">
				</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/ProjAgile/public/">Wijkraad</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Deelwijken <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Deelwijk A</a></li>
                            <li><a href="#">Deelwijk B</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Partners</a>
                    </li>
					<li>
                        <a href="#">Activiteiten</a>
                    </li>
					<li>
                        <a href="#">Forum</a>
                    </li>
					<li>
                        <a href="#">Contact</a>
                    </li>
					<li>
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Gebruikers <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Inloggen</a></li>
                            <li><a href="#">Admin Beheer</a></li>
                            <li><a href="#">Content Beheer</a></li>
                        </ul>
                    </li>
					<!--
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#">Partners</a></li>
							<li><a href="#">Activiteiten</a></li>
							<li><a href="#">Projecten</a></li>
							<li><a href="#">Contact</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
					-->
                <!--</ul>
            </div>
            <!-- /.navbar-collapse -->
        <!--</div>
        <!-- /.container -->
    <!--</nav>
