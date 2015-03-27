<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a href="/ProjAgile/public/">
                <img src="/ProjAgile/public/img/logo.png" />
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                {{--$menuData = $data['menuData'];--}}

                {{--foreach($menuData as $menuItem)--}}
                {{--{--}}
                    {{--if($menuItem->getParentId() == null)--}}
                    {{--{--}}
                        {{--//TODO add base url to path if not done => wijkraad/wijkraad/wijkraad/deelwijk/a--}}
{{--                        $hasChildren = false;--}}
{{--                        $hasGrandChildren = false;--}}
{{--                        $parentItemCreated = false;--}}
{{--                        foreach($menuData as $subMenuItem)--}}
{{--                        {--}}
                            {{--//Does this menuItem has children?--}}
{{--                            if($subMenuItem->getParentId() == $menuItem->getMenuId())--}}
{{--                            {--}}
{{--                                $hasChildren = true;--}}
{{--                                //If UL created--}}
{{--                                if($parentItemCreated)--}}
{{--                                {--}}
{{--                                    echo('<li><a href="/ProjAgile/Public/' . $menuItem->getRelativeUrL() . '/' . $subMenuItem->getRelativeUrl() . '">'. $subMenuItem->getName() . '</a></li>');--}}
{{--                                }--}}
{{--                                else--}}
{{--                                {--}}
{{--                                    $parentItemCreated = true;--}}
{{----}}
{{--                                    echo('<li>');--}}
{{--                                    echo(' <a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. $menuItem->getName() . '<span class="caret"></span></a>');--}}
{{--                                    echo('<ul class="dropdown-menu" role="menu">');--}}

                                    {{--//Third lvl menu--}}
                                    {{--/*foreach($menuData as $subSubMenuItem)--}}
                                    {{--{--}}
                                        {{--if($subSubMenuItem->getParentId() == $subMenuItem->getMenuId())--}}
                                        {{--{--}}
                                            {{--$hasGrandChildren = true;--}}
                                            {{--//TODO: voeg subsubItem toe volgens Leons css--}}
                                        {{--}--}}
                                    {{--}*/--}}
{{--                                    echo('<li><a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '/' . $subMenuItem->getRelativeUrl() . '">'. $subMenuItem->getName() . '</a></li>');--}}
{{--                                }--}}
{{----}}
{{--                            }--}}
{{--                        }--}}
{{--                        if($hasChildren)--}}
{{--                        {--}}
{{--                            echo('</ul></li>');--}}
{{--                        }--}}
{{--                        else--}}
{{--                        {--}}
{{--                            echo('<li>');--}}
{{--                            echo('<a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '">' . $menuItem->getName() . '</a>');--}}
{{--                            echo('</li>');--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
                    {{----}}
                {{--/*--}}
                {{--$menuData = $data['menuData'];--}}

                {{--foreach($menuData as $menuItem)--}}
                {{--{--}}
                    {{--if($menuItem->getParentId() == null)--}}
                    {{--{--}}
                        {{--//TODO add base url to path if not done => wijkraad/wijkraad/wijkraad/deelwijk/a--}}
                        {{--$hasChildren = false;--}}
                        {{--$parentItemCreated = false;--}}
                        {{--foreach($menuData as $subMenuItem)--}}
                        {{--{--}}
                            {{--//Does this menuItem has children?--}}
                            {{--if($subMenuItem->getParentId() == $menuItem->getMenuId())--}}
                            {{--{--}}
                                {{--//TODO add subsubMenuItem--}}
                                {{--$hasChildren = true;--}}
                                {{--//If UL created--}}
                                {{--if($parentItemCreated)--}}
                                {{--{--}}
                                    {{--echo('<li><a href="/ProjAgile/Public/' . $menuItem->getRelativeUrL() . '/' . $subMenuItem->getRelativeUrl() . '">'. $subMenuItem->getName() . '</a></li>');--}}
                                {{--}--}}
                                {{--else--}}
                                {{--{--}}
                                    {{--$parentItemCreated = true;--}}
                                    {{--echo('<li>');--}}
                                    {{--echo(' <a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. $menuItem->getName() . '<span class="caret"></span></a>');--}}
                                    {{--echo('<ul class="dropdown-menu" role="menu">');--}}
                                    {{--echo('<li><a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '/' . $subMenuItem->getRelativeUrl() . '">'. $subMenuItem->getName() . '</a></li>');--}}
                                {{--}--}}

                            {{--}--}}
                        {{--}--}}
                        {{--if($hasChildren)--}}
                        {{--{--}}
                            {{--echo('</ul></li>');--}}
                        {{--}--}}
                        {{--else--}}
                        {{--{--}}
                            {{--echo('<li>');--}}
                            {{--echo('<a href="/ProjAgile/Public/' . $menuItem->getRelativeUrl() . '">' . $menuItem->getName() . '</a>');--}}
                            {{--echo('</li>');--}}
                        {{--}--}}
                    {{--}--}}
                {{--}*/--}}
{{--                ?>--}}
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>