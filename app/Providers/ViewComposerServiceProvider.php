<?php 
    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use View;

    class ViewComposerServiceProvider extends ServiceProvider 
    {
        /**
         * Register bindings in the container.
         *
         * @return void
         */
        public function boot()
        {
            // Using class based composers...
            View::composer('partials._footer', 'App\Http\ViewComposers\FooterComposer');
            View::composer('partials._header', 'App\Http\ViewComposers\MenuComposer');
            View::composer('sidebar.edit', 'App\Http\ViewComposers\MenuComposer');
            View::composer('home.index', 'App\Http\ViewComposers\SidebarComposer');
            View::composer('home.partials._module-sidebar', 'App\Http\ViewComposers\SidebarComposer');
        }

        /**
         * Register
         *
         * @return void
         */
        public function register()
        {
            //
        }
    }