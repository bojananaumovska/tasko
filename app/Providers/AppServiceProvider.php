<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Carbon\Carbon;

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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notifications = Notification::where('user_id', Auth::id())
                    ->get()
                    ->map(function ($notification) {
                        // Format the created_at timestamp
                        $notification->created_at_human = Carbon::parse($notification->created_at)->diffForHumans();
                        return $notification;
                    });
                    
                $view->with('notifications', $notifications);
            }
        });
    }
}
