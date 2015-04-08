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
            View::composer('*', 'App\Http\ViewComposers\FooterComposer');
            View::composer('*', 'App\Http\ViewComposers\MenuComposer');
            View::composer('home.home', 'App\Http\ViewComposers\SidebarComposer');
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