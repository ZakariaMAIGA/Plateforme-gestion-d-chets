<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191); //On ajoute cette ligne pour eviter les erreurs sql
        // View::composer('*', function ($view) {
        //     if (Auth::guard('mairie')->check()) {
        //         $mairie = Auth::guard('mairie')->user()->mairie;
        //         $notifications = $mairie->compte->unreadNotifications;   //pour tester
        //         $view->with('notifications', $notifications);
        //     }
        // });
    }
}
