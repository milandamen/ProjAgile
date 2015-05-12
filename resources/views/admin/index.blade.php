@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('admin.index') !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h2 >Beheer</h2>
				<div class="col-md-12">
					<p class="col-md-8"> 
						Op deze pagina zijn alle elementen te vinden die men kan beheren.
						U heeft toegang tot alle onderdelen die hieronder te vinden zijn. Mocht u een onderdeel missen meld dit dan bij de beheerder!
					</p>
				  </div>
				<div class="col-md-12">
					@if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')
						<div class="col-md-3">
							<h3>Algemeen</h3>
							<div class="btn-group-vertical">
								<a class="btn btn-default" href="{{ route('page.index') }}" role="button">Pagina Beheer</a>
								<a class="btn btn-default" href="{{ route('menu.index') }}" role="button">Menu Wijzigen</a>
								<a class="btn btn-default" href="{{ route('footer.edit') }}" role="button">Footer Wijzigen</a>
							</div>
						</div>
						<div class="col-md-3">
							<h3>Homepage</h3>
							<div class="btn-group-vertical">
								<a class="btn btn-default" href="{{ route('home.editLayout') }}" role="button">Home Layout Wijzigen</a>
								<a class="btn btn-default" href="{{ route('carousel.edit') }}" role="button">Home Carrousel Wijzigen</a>
								<a class="btn btn-default" href="{{ route('sidebar.edit', 1) }}" role="button">Home Sidebar Wijzigen</a>
								<a class="btn btn-default" href="{{ route('home.editIntroduction')}}" role="button">Home Introductie Wijzigen</a>
							</div>
						</div>
						<div class="col-md-3">
							<h3>Nieuws</h3>
							<div class="btn-group-vertical">
								<a class="btn btn-default" href="{{ route('news.index') }}" role="button">Nieuws Overzicht</a>
								<a class="btn btn-default" href="{{ route('news.manage')}}" role="button">Nieuws Beheer</a>
								<a class="btn btn-default" href="{{ route('news.create') }}" role="button">Nieuws Toevoegen</a>
							</div>
						</div>
						<div class="col-md-3">
							<h3>Gebruikers beheer</h3>
							<div class="btn-group-vertical">
								<a class="btn btn-default" href="{{ route('user.index') }}" role="button">Gebruiker Overzicht</a>
								<a class="btn btn-default" href="{{ route('user.create') }}" role="button">Gebruiker Toevoegen</a>
							</div>
						</div>
					@elseif(Auth::check() && Auth::user()->usergroup->name === 'Content Beheerder')
						<div class="col-md-3">
							<h3>Homepage</h3>
							<div class="btn-group-vertical">
								<a class="btn btn-default" href="{{ route('carousel.edit') }}" role="button">Home Carrousel Wijzigen</a>
								<a class="btn btn-default" href="{{ route('sidebar.edit', 1) }}" role="button">Home Sidebar Wijzigen</a>
								<a class="btn btn-default" href="{{ route('home.editIntroduction')}}" role="button">Home Introductie Wijzigen</a>
							</div>
						</div>
						<div class="col-md-3">
							<h3>Nieuws</h3>
							<div class="btn-group-vertical">
								<a class="btn btn-default" href="{{ route('news.index') }}" role="button">Nieuws Overzicht</a>
								<a class="btn btn-default" href="{{ route('news.create') }}" role="button">Nieuws Toevoegen</a>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@stop