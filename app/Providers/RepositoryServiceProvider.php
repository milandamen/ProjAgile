<?php
	namespace App\Providers;

	use Illuminate\Support\ServiceProvider;

	class RepositoryServiceProvider extends ServiceProvider
	{

		/**
		 * Register bindings in the container.
		 *
		 * @return void
		 */
		public function register()
		{
			$this->InitEntityRepositories();
		}

		/**
		 * Binds all the Entity repositories to their respective interfaces
		 * This will allow us to inject interfaces instantiations in the controllers
		 * which will allow better testing capabilities.
		 * 
		 * @return void
		 */
		private function InitEntityRepositories()
		{
			$this->app->bind('App\Repositories\RepositoryInterfaces\IAddressRepository',			'App\Repositories\EntityRepositories\EntityAddressRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\ICarouselRepository',			'App\Repositories\EntityRepositories\EntityCarouselRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IDistrictSectionRepository',	'App\Repositories\EntityRepositories\EntityDistrictSectionRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IFileRepository',				'App\Repositories\EntityRepositories\EntityFileRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IFooterRepository',				'App\Repositories\EntityRepositories\EntityFooterRepository');

			$this->app->bind('App\Repositories\RepositoryInterfaces\IHomeLayoutRepository',			'App\Repositories\EntityRepositories\EntityHomeLayoutRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IHouseNumberRepository',		'App\Repositories\EntityRepositories\EntityHouseNumberRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IIntroductionRepository',		'App\Repositories\EntityRepositories\EntityIntroductionRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IMenuRepository',				'App\Repositories\EntityRepositories\EntityMenuRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\INewOnSiteRepository',			'App\Repositories\EntityRepositories\EntityNewOnSiteRepository');

			$this->app->bind('App\Repositories\RepositoryInterfaces\INewsCommentRepository',		'App\Repositories\EntityRepositories\EntityNewsCommentRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\INewsRepository',				'App\Repositories\EntityRepositories\EntityNewsRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IPagePanelRepository',			'App\Repositories\EntityRepositories\EntityPagePanelRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IPageRepository',				'App\Repositories\EntityRepositories\EntityPageRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IPanelRepository',				'App\Repositories\EntityRepositories\EntityPanelRepository');

			$this->app->bind('App\Repositories\RepositoryInterfaces\IPostalRepository',				'App\Repositories\EntityRepositories\EntityPostalRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\ISidebarRepository',			'App\Repositories\EntityRepositories\EntitySidebarRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IUserGroupRepository',			'App\Repositories\EntityRepositories\EntityUserGroupRepository');
			$this->app->bind('App\Repositories\RepositoryInterfaces\IUserRepository',				'App\Repositories\EntityRepositories\EntityUserRepository');
		}
	}