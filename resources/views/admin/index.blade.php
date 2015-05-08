@extends('app')

@section('content')
    <div class="container">
    	<div class="row">
				{!! Breadcrumbs::render('manage') !!}
			</div>

        <!-- Features Section -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 >Beheer</h2>
                        <p class="col-md-8"> Op deze pagina zijn alle elementen te vinden die men kan beheren.
                        	U heeft toegang tot alle onderdelen die hieronder te vinden zijn. Mocht u een onderdeel missen meld dit dan bij de beheerder!</p>

					<div class="col-lg-12">
                        @if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')
                    
                       <div class="col-md-3">
	           			<h3>Algemeen</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="{{ route('page.index') }}" role="button">Pagina beheer</a>
	           					<a class="btn btn-default" href="{{ route('menu.index') }}" role="button">Menu wijzigen</a>
								<a class="btn btn-default" href="{{ route('footer.edit') }}" role="button">Footer wijzigen</a>
	           				</div>
           				</div>
           				<div class="col-md-3">
	           				<h3>Homepage</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="{{ route('home.editLayout') }}" role="button">Homepage layout </a>
								<a class="btn btn-default" href="{{ route('carousel.edit') }}" role="button">Carrousel wijzigen</a>
								<a class="btn btn-default" href="{{ route('sidebar.edit', 1) }}" role="button">Sidebar Home wijzigen</a>
	           					<a class="btn btn-default" href="{{ route('home.editIntroduction')}}" role="button">Introductie wijzigen</a>

	           				</div>
           				</div>
           				<div class="col-md-3">
	           				<h3>Nieuws</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="{{ route('news.index') }}" role="button">Nieuws overzicht</a>
	           					<a class="btn btn-default" href="{{ route('news.manage')}}" role="button">Nieuws beheer</a>
	           					<a class="btn btn-default" href="{{ route('news.create') }}" role="button">Nieuws toevoegen</a>
	           				</div>
           				</div>
           				<div class="col-md-3">
	           				<h3>Gebruikers beheer</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="{{ route('user.index') }}" role="button">Gebruiker overzicht</a>
	           					<a class="btn btn-default" href="{{ route('user.create') }}" role="button">Gebruiker toevoegen</a>

	           				</div>
	           			</div>

                    @elseif(Auth::check() && Auth::user()->usergroup->name === 'Content Beheerder')
                    
           				<div class="col-md-3">
	           				<h3>Homepage</h3>
	           				<div class="btn-group-vertical">
								<a class="btn btn-default" href="{{ route('carousel.edit') }}" role="button">Carrousel wijzigen</a>
								<a class="btn btn-default" href="{{ route('sidebar.edit', 1) }}" role="button">Sidebar Home wijzigen</a>
	           					<a class="btn btn-default" href="{{ route('home.editIntroduction')}}" role="button">Introductie wijzigen</a>
	           				</div>
           				</div>
           				<div class="col-md-3">
	           				<h3>Nieuws</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="{{ route('news.index') }}" role="button">Nieuws overzicht</a>
	           					<a class="btn btn-default" href="{{ route('news.create') }}" role="button">Nieuws toevoegen</a>
	           				</div>
           				</div>
           				
                        @endif
                          </div>
                </div>
            </div>
    </div>
@stop