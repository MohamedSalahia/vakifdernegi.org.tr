<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;

use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

Route::prefix(LaravelLocalization::setLocale())
    ->group(function () {
        // Donation cart
        Route::get('cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
        Route::post('cart/add', [\App\Http\Controllers\CartController::class, 'add'])->middleware('throttle:30,1')->name('add.to.cart');
        Route::post('cart/update', [\App\Http\Controllers\CartController::class, 'update'])->middleware('throttle:30,1')->name('cart.update');
        Route::post('cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->middleware('throttle:30,1')->name('cart.remove');
        Route::post('campaign/{campaign}/share', [\App\Http\Controllers\WebController::class, 'campaignShare'])->middleware('throttle:20,1')->name('campaign.share');

        // Donation checkout (campaign / zakat / cart)
        Route::get('donate/campaign/{campaign}', [\App\Http\Controllers\DonationController::class, 'campaign'])->name('donate.campaign');
        Route::get('donate/zakat', [\App\Http\Controllers\DonationController::class, 'zakat'])->name('donate.zakat');
        Route::get('donate/quick', [\App\Http\Controllers\DonationController::class, 'quick'])->name('donate.quick');
        Route::get('donate/cart', [\App\Http\Controllers\DonationController::class, 'cart'])->name('donate.cart');
        Route::post('donate', [\App\Http\Controllers\DonationController::class, 'store'])->middleware('throttle:10,1')->name('donate.store');
        Route::get('donate/thanks/{donation}', [\App\Http\Controllers\DonationController::class, 'show'])->middleware('signed')->name('donate.show');
    });



// Google sign-in (fixed, non-localized callback URL to register in Google Cloud Console)
Route::middleware('guest')->group(function () {
    Route::get('auth/google', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'redirect'])->name('auth.google');
    Route::get('auth/google/callback', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'callback'])->name('auth.google.callback');
});

Route::any('/thumbnail/{width}/{height}/{quality}/{filepath}', 'App\Http\Controllers\ImageController@getImage')->where(['filepath' => '.*']);


Route::prefix(LaravelLocalization::setLocale())
    ->middleware([
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
    ])
    ->group(function () {

        Route::get('/', 'App\Http\Controllers\WebController@index')->name('/');

        Route::get('bank_accounts', 'App\Http\Controllers\WebController@bank_accounts')->name('bank_accounts');
        Route::get('/privacy', 'App\Http\Controllers\WebController@privacy')->name('privacy');

        // donor account ("Hesabım")
        Route::get('/account', [\App\Http\Controllers\AccountController::class, 'index'])->name('account');
        Route::put('/account/profile', [\App\Http\Controllers\AccountController::class, 'updateProfile'])->name('account.profile');
        Route::put('/account/password', [\App\Http\Controllers\AccountController::class, 'updatePassword'])->name('account.password');
        Route::get('/account/donations/{donation}', [\App\Http\Controllers\AccountController::class, 'show'])->name('account.donations.show');
        Route::get('/account/donations/{donation}/receipt', [\App\Http\Controllers\AccountController::class, 'receipt'])->name('account.donations.receipt');
        Route::get('/account/donations/{donation}/repeat', [\App\Http\Controllers\AccountController::class, 'repeat'])->name('account.donations.repeat');
        Route::get('/transparency', [\App\Http\Controllers\TransparencyController::class, 'transparency'])->name('transparency');
        Route::get('/reports', [\App\Http\Controllers\TransparencyController::class, 'reports'])->name('reports');
        Route::get('/help', [\App\Http\Controllers\TransparencyController::class, 'help'])->name('help');
        Route::get('/terms-of-use', 'App\Http\Controllers\WebController@terms_of_use')->name('terms-of-use');
        Route::get('/donation-policy', 'App\Http\Controllers\WebController@donation_policy')->name('donation-policy');
        Route::get('/delivery-and-refund-policy', 'App\Http\Controllers\WebController@delivery_and_refund')->name('delivery-and-refund-policy');


        //Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/blogs', 'App\Http\Controllers\WebController@blogs')->name('blogs');
        Route::get('/zakat', 'App\Http\Controllers\WebController@zakat')->name('zakat');
        Route::get('/campaigns', 'App\Http\Controllers\WebController@campaigns')->name('campaigns');
        Route::get('/completed-campaigns', 'App\Http\Controllers\WebController@completed_campaigns')->name('completed-campaigns');
        Route::get('/about_us', 'App\Http\Controllers\WebController@about')->name('about_us');
        Route::get('/contact_us', 'App\Http\Controllers\WebController@contact')->name('contact_us');

        Route::post('contact', 'App\Http\Controllers\WebController@contact_form')->middleware('throttle:5,1')->name('contact.post');
        Route::post('subscribe', 'App\Http\Controllers\WebController@subscribe')->name('subscribe.post');
        Route::get('page/{page}/{slug?}', 'App\Http\Controllers\WebController@page')->name('page.show');
        Route::get('blog/{blog}/{slug?}', 'App\Http\Controllers\WebController@single_blog')->name('blog.show');
        Route::get('campaign/{campaign}/{slug?}', 'App\Http\Controllers\WebController@single_campaign')->name('campaign.show');
        Route::get('campaign-completed/{campaign}/{slug?}', 'App\Http\Controllers\WebController@single_campaign_complete')->name('campaign-completed.show');
        Route::get('category/{category}/{slug?}', 'App\Http\Controllers\WebController@category_show')->name('category.show');
        Route::get('campaign/category/{id}/{slug?}', 'App\Http\Controllers\WebController@campaignCategory')->name('campaign.category.show');

        // Authentication Routes...
        Route::redirect('cp', 'login');
        Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
        // passwordless sign-in with an e-mailed code
        Route::get('login/code', [\App\Http\Controllers\Auth\EmailCodeController::class, 'showRequest'])->name('login.code');
        Route::post('login/code', [\App\Http\Controllers\Auth\EmailCodeController::class, 'send'])->middleware('throttle:5,1')->name('login.code.send');
        Route::get('login/code/verify', [\App\Http\Controllers\Auth\EmailCodeController::class, 'showVerify'])->name('login.code.verify');
        Route::post('login/code/verify', [\App\Http\Controllers\Auth\EmailCodeController::class, 'verify'])->middleware('throttle:10,1')->name('login.code.check');
        Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
        //Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');



        Route::group(['middleware' => ['admin']], function () {

        });

        //user register
        //Route::get('user/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('user.register');
        //Route::post('user/register', 'App\Http\Controllers\Auth\RegisterController@register');

        /*Route::get('user/login', 'App\Http\Controllers\Auth\RegisterController@showUserLoginForm')->name('user.login');
        Route::post('user/login', 'App\Http\Controllers\Auth\RegisterController@userLogin');*/


        //Route::get('user/login', 'App\Http\Controllers\Auth\LoginController@showUserLoginForm')->name('user.login');
        //Route::post('user/login', 'App\Http\Controllers\Auth\LoginController@userLogin');

        //user profile

        Route::middleware('role:user|super_admin')->get('user/profile/{user}', 'App\Http\Controllers\WebController@showUserProfile')->name('user.profile');



    });

