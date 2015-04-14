@extends('app')

@section('content')
    <div class="container">
    	<div class="row">
				{!! Breadcrumbs::render('manage') !!}
			</div>

        <!-- Features Section -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Beheer</h2>
                        <p> Op deze pagina zijn alle elementen te vinden die men kan beheren.</p>
                        <p> U heeft toegang tot alle onderdelen die hieronder te vinden zijn. Mocht u een onderdeel missen meld dit dan bij de beheerder!</p>

                        @if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')
                    <div class="col-lg-8 col-md-offset-2">
                       <div class="col-md-4">
	           			<h3>Layout modules</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="{{ route('home.editLayout') }}" role="button">Homepage layout </a>
								<a class="btn btn-default" href="{{ route('carousel.edit') }}" role="button">Carrousel wijzigen</a>
								<a class="btn btn-default" href="{{ route('sidebar.edit', 1) }}" role="button">Sidebar Home wijzigen</a>
								<a class="btn btn-default" href="{{ route('menu.index') }}" role="button">Menu wijzigen</a>
								<a class="btn btn-default" href="{{ route('footer.edit') }}" role="button">Footer wijzigen</a>
	           				</div>
           				</div>
           				<div class="col-md-4">
	           				<h3>Content wijzigen</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="#" role="button">Nieuws toevoegen</a>
	           					<a class="btn btn-default" href="{{ route('home.editIntroduction')}}" role="button">Introductie wijzigen</a>
	           				</div>
           				</div>

           				<div class="col-md-4">
	           				<h3>Gebruikers beheer</h3>
	           				<div class="btn-group-vertical">
	           					<a class="btn btn-default" href="#" role="button">Content beheerders</a>
	           					<a class="btn btn-default" href="#" role="button">Administrators</a>
	           					<a class="btn btn-default" href="#" role="button">Deelwijken</a>
	           				</div>
	           			</div>
                    
                    </div>
                    @elseif(Auth::check() && Auth::user()->usergroup->name === 'Content Beheerder')
                    <div class="col-md-4">
                            <h3>Layout modules</h3>
                            <div class="btn-group-vertical">
                                    <a class="btn btn-default" href="{{ route('carousel.edit') }}" role="button">Carrousel wijzigen</a>
                                    <a class="btn btn-default" href="{{ route('sidebar.edit', 1) }}" role="button">Sidebar Home wijzigen</a>
                            </div>
           			    </div>
                        <div class="col-md-4">
                            <h3>Content wijzigen</h3>
                            <div class="btn-group-vertical">
                                <a class="btn btn-default" href="#" role="button">Nieuws toevoegen</a>
                                <a class="btn btn-default" href="{{ route('home.editIntroduction') }}" role="button">Introductie wijzigen</a>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
    </div>
@stop