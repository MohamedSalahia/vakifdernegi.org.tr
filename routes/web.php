<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;

use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

Route::get('testMail', [\App\Http\Controllers\WebController::class, 'testMail'])->name('testMail');
Route::get('iyzico/{id}', [\App\Http\Controllers\WebController::class, 'showPaymentFormLive'])->name('payment.iyzico.live');


Route::prefix(LaravelLocalization::setLocale())
    ->group(function () {
        Route::get('cart', [\App\Http\Controllers\WebController::class, 'cart'])->name('cart');

    });


Route::get('payment/zakat', [\App\Http\Controllers\WebController::class, 'showPaymentFormZakat'])->name('payment.zakat');
Route::get('add-to-cart', [\App\Http\Controllers\WebController::class, 'addToCartPost'])->name('add.to.cart');
//Route::get('cart', [\App\Http\Controllers\WebController::class, 'cart'])->name('cart');
Route::get('cart/remove', [\App\Http\Controllers\WebController::class, 'cartRemove'])->name('cart.remove');
Route::post('/knet/response', [\App\Http\Controllers\WebController::class, 'showPaymentFormBack'])->name('payment.response');
Route::get('/knet/error', [\App\Http\Controllers\KnetPaymentController::class, 'paymentError'])->name('payment.error');
Route::get('/payment/status', [\App\Http\Controllers\WebController::class, 'paymentStatus'])->name('payment.status');
Route::get('iyzico', [\App\Http\Controllers\WebController::class, 'showPaymentForm'])->name('payment.iyzico');

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([
        'auth',
    ])
    ->group(function () {

        Route::get('cart/quantity/update', [\App\Http\Controllers\WebController::class, 'cartQuantityUpdate'])->name('cart.quantity.update');
        Route::get('payment_success', [\App\Http\Controllers\StripePaymentController::class, 'paymentSuccess'])->name('payment_success');
        Route::get('payment_cancel', [\App\Http\Controllers\StripePaymentController::class, 'paymentCancel'])->name('payment_cancel');
        Route::get('stripe/{id}', [\App\Http\Controllers\StripePaymentController::class, 'stripePostLive'])->name('stripe.checkout.live');

        Route::controller(\App\Http\Controllers\StripePaymentController::class)->group(function(){
            Route::get('stripe', 'stripePost')->name('stripe.checkout');
        });
        //knet
        //Route::get('knet', [\App\Http\Controllers\WebController::class, 'showPaymentForm'])->name('payment.knet');


    });

//Clear Cache facade value:
Route::get('/fix', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>Cache facade value cleared</h1>';
});
// FCM

//for facebook
Route::get('/callback', 'WelcomeController@callback')->name('callback');

Route::get('/terms', 'WelcomeController@terms')->name('terms');

Route::any('/thumbnail/{width}/{height}/{quality}/{filepath}', 'App\Http\Controllers\ImageController@getImage')->where(['filepath' => '.*']);

Route::post('/post/image/upload', 'TinyController@uploadImage')->name('post.image.upload');
Route::post('/uppy/image/upload', 'TinyController@uppyImage')->name('uppy.image.upload');


Route::prefix(LaravelLocalization::setLocale())
    ->middleware([
        'auth',
    ])
    ->group(function () {

        Route::get('/appointment', 'App\Http\Controllers\WebController@appointment')->name('appointment');


    });



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
        Route::get('/terms-of-use', 'App\Http\Controllers\WebController@terms_of_use')->name('terms-of-use');
        Route::get('/donation-policy', 'App\Http\Controllers\WebController@donation_policy')->name('donation-policy');
        Route::get('/delivery-and-refund-policy', 'App\Http\Controllers\WebController@delivery_and_refund')->name('delivery-and-refund-policy');
        Route::get('said_about_us', 'App\Http\Controllers\WebController@said_about_us')->name('said_about_us');
        Route::get('kudus', 'App\Http\Controllers\WebController@kudus')->name('kudus');


        //Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/blogs', 'App\Http\Controllers\WebController@blogs')->name('blogs');
        Route::get('/zakat', 'App\Http\Controllers\WebController@zakat')->name('zakat');
        Route::get('/campaigns', 'App\Http\Controllers\WebController@campaigns')->name('campaigns');
        Route::get('/completed-campaigns', 'App\Http\Controllers\WebController@completed_campaigns')->name('completed-campaigns');
        Route::get('/about_us', 'App\Http\Controllers\WebController@about')->name('about_us');
        Route::get('/contact_us', 'App\Http\Controllers\WebController@contact')->name('contact_us');

        Route::post('contact', 'App\Http\Controllers\WebController@contact_form')->name('contact.post');
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
        Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
        //Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');



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

