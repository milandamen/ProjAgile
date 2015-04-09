<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {!! HTML::image('custom/img/logo.png') !!}
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-info"></i> Over Ons</a></li>
                <li><a href="#"><i class="fa fa-paper-plane"></i> Contact</a></li>
            </ul>
            <div class="span10">
                <div class="row"></div>
            <div>

            <ul class="nav navbar-nav">
                @foreach($menu as $subMenu)

                    @if(isset($subMenu['sub']))

                        @include('partials.menu.subItem', ['items' => $subMenu['sub'],'main' =>$subMenu])

                    @else

                        <li><a href="{!! $subMenu['main']->relativeUrl !!}">{!! $subMenu['main']->name !!}</a></li>

                    @endif

                @endforeach

            </ul>

        </div>
    </div>
</nav>

