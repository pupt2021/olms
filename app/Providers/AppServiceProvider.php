<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Auth $auth)
    {

        view()->composer('*', function ($view)
        {

            if(auth::check() == true){
                $id = auth::user()->id;
                $parent_nav_links = db::table('user_links_parent')->get();
                $nav_links = DB::table('user_links')->get();

                $user_permission = db::table('user_permission')->where('user_id', $id)->get();

                //...with this variable
                $view->with(['user_links' => $nav_links, 'user_links_parent' => $parent_nav_links , 'permission' => $user_permission]);
            }else{
                $id = '';
            }


        });


    }
}
