<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('home/home', 'App\Http\ViewComposers\SidebarComposer');
        View::composer('*', 'App\Http\ViewComposers\MenuComposer');
        View::composer('*', 'App\Http\ViewComposers\FooterComposer');

        // // Using Closure based composers...
        // View::composer('dashboard', function()
        // {

        // });
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