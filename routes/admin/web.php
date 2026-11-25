<?php
// editor image uploads (admins only)
Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    Route::post('/post/image/upload', 'TinyController@uploadImage')->name('post.image.upload');
    Route::post('/uppy/image/upload', 'TinyController@uppyImage')->name('uppy.image.upload');
});

// Facebook login
Route::get('login/facebook', [App\Http\Controllers\Admin\FaceBookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Admin\FaceBookController::class, 'handleFacebookCallback']);

// Google login
Route::get('login/google', [App\Http\Controllers\Admin\GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Admin\GoogleController::class, 'handleGoogleCallback']);

// Twitter login
Route::get('login/twitter', [App\Http\Controllers\Admin\TwitterController::class, 'redirectToTwitter'])->name('login.twitter');
Route::get('login/twitter/callback', [App\Http\Controllers\Admin\TwitterController::class, 'handleTwitterCallback']);

Route::prefix(LaravelLocalization::setLocale())->middleware([
    'localeSessionRedirect',
    'localizationRedirect',
    'localeViewPath',
    'auth',
    'role:admin|super_admin',
])
    ->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {

            //home
            Route::get('/home/top_statistics', 'HomeController@topStatistics')->name('home.top_statistics');
            Route::get('/home/movies_chart', 'HomeController@moviesChart')->name('home.movies_chart');
            Route::get('/home', 'HomeController@index')->name('home');

            //user routes
            Route::get('/users/data', 'UserController@data')->name('users.data');
            Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
            Route::resource('users', 'UserController');

            //slider routes
            Route::get('/sliders/data', 'SliderController@data')->name('sliders.data');
            Route::delete('/sliders/bulk_delete', 'SliderController@bulkDelete')->name('sliders.bulk_delete');
            Route::resource('sliders', 'SliderController');

            // change password routes
            Route::get('change-password/{id}', 'ChangePasswordController@index')->name('password.reset');
            Route::post('change-password/{id}', 'ChangePasswordController@store')->name('change.password');

            //blog routes
            Route::get('/blogs/data', 'BlogController@data')->name('blogs.data');
            Route::delete('/blogs/bulk_delete', 'BlogController@bulkDelete')->name('blogs.bulk_delete');
            Route::resource('blogs', 'BlogController');

            //video routes
            Route::get('/videos/data', 'VideoController@data')->name('videos.data');
            Route::delete('/videos/bulk_delete', 'VideoController@bulkDelete')->name('videos.bulk_delete');
            Route::resource('videos', 'VideoController');

            //photo routes
            Route::get('/photos/data', 'PhotoController@data')->name('photos.data');
            Route::delete('/photos/bulk_delete', 'PhotoController@bulkDelete')->name('photos.bulk_delete');
            Route::resource('photos', 'PhotoController');

            //contacts routes
            Route::get('/contacts/data', 'ContactController@data')->name('contacts.data');
            Route::delete('/contacts/bulk_delete', 'ContactController@bulkDelete')->name('contacts.bulk_delete');
            Route::resource('contacts', 'ContactController');


            //subscribes routes
            Route::get('/subscribes/data', 'SubscribeController@data')->name('subscribes.data');
            Route::delete('/subscribes/bulk_delete', 'SubscribeController@bulkDelete')->name('subscribes.bulk_delete');
            Route::resource('subscribes', 'SubscribeController');


            //category routes
            Route::get('/categories/data', 'CategoryController@data')->name('categories.data');
            Route::delete('/categories/bulk_delete', 'CategoryController@bulkDelete')->name('categories.bulk_delete');
            Route::resource('categories', 'CategoryController');

            //page category routes
            Route::get('/page_categories/data', 'PageCategoryController@data')->name('page_categories.data');
            Route::delete('/page_categories/bulk_delete', 'PageCategoryController@bulkDelete')->name('page_categories.bulk_delete');
            Route::resource('page_categories', 'PageCategoryController');

            //user donations routes
            Route::get('/user_donations/data', 'UserDonationController@data')->name('user_donations.data');
            Route::delete('/user_donations/bulk_delete', 'UserDonationController@bulkDelete')->name('user_donations.bulk_delete');
            Route::resource('user_donations', 'UserDonationController');

            //page routes
            Route::get('/pages/data', 'PageController@data')->name('pages.data');
            Route::delete('/pages/bulk_delete', 'PageController@bulkDelete')->name('pages.bulk_delete');
            Route::resource('pages', 'PageController');

            //campaigns routes
            Route::get('/campaigns/data', 'CampaignController@data')->name('campaigns.data');
            Route::delete('/campaigns/bulk_delete', 'CampaignController@bulkDelete')->name('campaigns.bulk_delete');
            Route::resource('campaigns', 'CampaignController');

            //campaign_categories routes
            Route::get('/campaign_categories/data', 'CampaignCategoryController@data')->name('campaign_categories.data');
            Route::delete('/campaign_categories/bulk_delete', 'CampaignCategoryController@bulkDelete')->name('campaign_categories.bulk_delete');
            Route::resource('campaign_categories', 'CampaignCategoryController');

            //setting routes
            Route::get('/settings/general', 'SettingController@general')->name('settings.general');
            // Route::get('/settings/social_links', 'SettingController@socialLinks')->name('settings.social_links');
            // Route::get('/settings/mobile_links', 'SettingController@mobileLinks')->name('settings.mobile_links');
            Route::resource('settings', 'SettingController')->only(['store']);

            //profile routes
            Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
            Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

            //

            Route::get('/knet_transactions/{knetTransaction}', 'UserDonationController@show')->name('knet_transactions.show');


            //FCM routes
            /*Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
            Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

            Route::get('/fcm', 'HomeController@fcm')->name('fcm');
            Route::post('/save-token', 'HomeController@saveToken')->name('save-token');
            Route::post('/send-notification', 'HomeController@sendNotification')->name('send.notification');*/

        });

    });
