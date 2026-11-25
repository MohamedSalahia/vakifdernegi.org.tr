<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Site settings are edited from the admin panel and saved to storage/app/settings.json,
        // which is not tracked by git (so admin edits never block deployments).
        // On first boot it is created from the tracked defaults in storage/settings.json.
        $runtime = storage_path('app/settings.json');
        $defaults = storage_path('settings.json');
        if (!file_exists($runtime) && file_exists($defaults)) {
            @copy($defaults, $runtime);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // A guest's donation cart follows them into their account when they log in.
        Event::listen(Login::class, function (Login $event) {
            app(\App\Services\CartService::class)->mergeGuestCartInto($event->user->getAuthIdentifier());
        });

        // Site layout partials need these on every page (not only WebController pages),
        // e.g. password reset, error pages and the donation checkout.
        View::composer('layouts.web.*', function ($view) {
            $data = $view->getData();
            if (!isset($data['campaignCategories'])) {
                $view->with('campaignCategories', \App\Models\CampaignCategory::all());
            }
            if (!isset($data['categories'])) {
                $view->with('categories', \App\Models\Category::all());
            }
            if (!isset($data['photos'])) {
                $view->with('photos', \App\Models\Photo::all());
            }
        });
    }
}
