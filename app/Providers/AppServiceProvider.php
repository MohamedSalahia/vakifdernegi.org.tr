<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
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
