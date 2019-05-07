<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AppServiceProvider extends ServiceProvider
{
    use AuthenticatesUsers;
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
    public function boot()
    {
        //
        Validator::extend('is_active',function($attribute,$value,$parameters,$validator){
            $model = \App\User::where($attribute,$value)->where('status',1)->first();
            return $model ? true : false;
        },'User belum aktif, mohon cek kembali email anda.');
    }
}
