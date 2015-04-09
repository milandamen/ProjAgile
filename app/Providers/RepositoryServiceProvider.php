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
         * which will allow better testing capabilities
         * 
         * @return void
         */
        private function InitEntityRepositories()
        {
            $this->app->bind('App\Repositories\RepositoryInterfaces\ICarouselRepository',           'App\Repositories\EntityRepositories\EntityCarouselRepository');
            $this->app->bind('App\Repositories\RepositoryInterfaces\IDistrictsectionRepository',    'App\Repositories\EntityRepositories\EntityDistrictsection');
            $this->app->bind('App\Repositories\RepositoryInterfaces\IFileRepository',               'App\Repositories\EntityRepositories\EntityFileRepository');
            $this->app->bind('App\Repositories\RepositoryInterfaces\IFooterRepository',             'App\Repositories\EntityRepositories\EntityFooterRepository');
            $this->app->bind('App\Repositories\RepositoryInterfaces\IHomeLayoutRepository',         'App\Repositories\EntityRepositories\EntityHomeLayoutRepository');
            $this->app->bind('App\Repositories\RepositoryInterfaces\IIntroductionRepository',       'App\Repositories\EntityRepositories\EntityIntroductionRepository');
            $this->app->bind('App\Repositories\RepositoryInterfaces\IMenuRepository',               'App\Repositories\EntityRepositories\EntityMenuRepository');
            $this->app->bind('App\Repositories\RepositoryInterfaces\INewsRepository',               'App\Repositories\EntityRepositories\EntityNewsRepository');
            $this->app->bind('App\Repositories\RepositoryInterfaces\ISidebarRepository',            'App\Repositories\EntityRepositories\EntitySidebarRepository');
            $this->app->bind('App\Repositories\RepositoryInterfaces\IUserRepository',               'App\Repositories\EntityRepositories\EntityUserRepository');
        }
    }