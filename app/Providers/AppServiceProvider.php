<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\URL;

//下記を追加！
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        //本番環境では、Laravelによって生成されるすべてのURLにスキームの使用が強制され、すべてのlinks、assets,redirectsで HTTPではなく HTTPSが使用されるようになる
        if($this->app->environment('production')){
            URL::forceScheme('https');
        }

        //パジネーター追加！
        Paginator::useBootstrap();


        //Gate追加
        Gate::define('admin',function($user){
            return $user->role_id === User::ADMIN_ROLE_ID;
        });
    }
}

