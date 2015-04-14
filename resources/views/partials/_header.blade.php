<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a href="{{ route('home.index') }}">{!! HTML::image('custom/img/logo.png') !!}</a>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-info"></i> Over Ons</a></li>
                <li><a href="#"><i class="fa fa-paper-plane"></i> Contact</a></li>

                @if (!Auth::check())
                    <li>
                        <a href="{{ route('auth.login') }}">
                            <i class="fa fa-spinner"></i> Inloggen
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('auth.logout') }}">
                            <i class="fa fa-spinner"></i> Uitloggen
                        </a>
                    </li>
                @endif

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                    <ul class="dropdown-menu" style="padding:12px;">
                        {!! Form::model(null, ['class' => 'navbar-form', 'role' => 'search']) !!}
                            <div class="input-group">
                                <div class="col-md-12" style="padding:0">
                                {!! Form::text('query', null, ['placeholder' => 'Zoeken...', 'class' => 'form-control','style' => 'cols="20"']) !!}
                                </div>
                                    <div class="input-group-btn">
                                        {!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['type' => 'submit', 'class' => 'btn btn-default']) !!}
                                    </div>

                            </div>
                        {!! Form::close() !!}
                    </ul>
                </li>
            </ul>

            <div class="span10">
                <div class="row"></div>
                    <ul class="nav navbar-nav">
                        @foreach($menu as $subMenu)
                            @if(isset($subMenu['sub']))
								<li class="dropdown pos-relative">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $subMenu['main']->name }} <span class="caret"></span></a>
									<ul class="dropdown-menu">
										@include('partials.menu._subMenuItem', ['items' => $subMenu['sub'],'main' =>$subMenu])
									</ul>
								</li>
                            @else
                                <li>
									<a href="{{ url($item['main']->relativeUrl) }}">{{ $subMenu['main']->name }}</a>
								</li>
                            @endif
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
</nav>