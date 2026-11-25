<?php

namespace App\Http\Controllers;

use App\Models\CampaignCategory;
use App\Models\Cart;
use App\Traits\CartTrait;
use App\Models\Blog;
use App\Models\Campaign;
use App\Models\Page;
use App\Models\Photo;
use App\Models\User;
use App\Models\Slider;
use App\Models\Subscribe;
use App\Models\Contact;
use App\Models\UserCart;
use App\Models\Video;
use App\Models\Category;
use Asciisd\Knet\Events\KnetResponseHandled;
use Asciisd\Knet\Events\KnetResponseReceived;
use Asciisd\Knet\Events\KnetTransactionHasErrors;
use Asciisd\Knet\Events\KnetTransactionUpdated;
use Asciisd\Knet\KnetTransaction;
use Asciisd\Knet\KPayResponseHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\View;
use Auth;
use Session;
use Intervention\Image\Facades\Image;
use Asciisd\Knet\Knet;
use Asciisd\Knet\KPayManager;
use Asciisd\Knet\Payment;
use Illuminate\Support\Str;


class WebController extends Controller
{
    use cartTrait;
    public function __construct(){

        //dd(Auth::check());
        $categories = Category::all();
        //$campaignCategories = CampaignCategory::all();
        //$campaignCategories = CampaignCategory::where('status', 'active')->where('complete', 'no')->with('category')->get();
        $campaignCategories = CampaignCategory::all();
        //dd($campaignCategories);
        $photos = Photo::all();
        View::share('categories', $categories);
        View::share('photos', $photos);
        View::share('campaignCategories', $campaignCategories);
    }

    public function index()
    {

        $latest_blogs = Blog::orderBy('id', 'asc')->take(2)->get();
        $sliders = Slider::all();
        $photos = Photo::all();
        $campaigns = Campaign:: where('status', 'active')->where('complete', 'no')->with('category')->latest()->take(3)->get();
        $campaigns_not_completed = Campaign:: where('status', 'active')->where('complete', 'no')->with('category')->latest()->take(3)->get();
        $campaigns_completed = Campaign:: where('status', 'active')->where('complete', 'yes')->with('category')->latest()->take(3)->get();
        //dd($campaigns);
        $blogs = Blog::latest()->take(3)->get();
        return view('web.home', compact('latest_blogs', 'sliders', 'blogs', 'photos', 'campaigns', 'campaigns_not_completed', 'campaigns_completed'));

    }// end of index

    public function blogs(Request $request)
    {
        $blogs = Blog::with('category')->when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->latest()->paginate(3);

        //dd($blogs);

        return view('web.blogs', compact('blogs'));

    }// end of index

    public function zakat(Request $request)
    {
        return view('web.zakat');
    }// end of index

    public function campaigns(Request $request)
    {
        $campaigns = Campaign::where('status', 'active')->where('complete', 'no')->with('category')->when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->get();
        //dd($campaigns);
        return view('web.campaigns', compact('campaigns'));

    }// end of index

    public function completed_campaigns(Request $request)
    {
        $campaigns_completed = Campaign::where('status', 'active')->where('complete', 'yes')->with('category')->when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->latest()->paginate(6);
        //dd($campaigns);

        return view('web.completed_campaigns', compact('campaigns_completed'));

    }// end of index

    public function blog_show(Blog $blog)
    {

        $blog = Blog::whereTranslationLike('name_slug', '%' . $slug . '%')->with('category')->get();

        //dd($blog);

        return view('web.blog', compact('blog'));

    }// end of index

    public function contact()
    {
        return view('web.contact_us');

    }// end of index

    public function about()
    {
        //$doctor_categories = DoctorCategory::orderby('id', 'asc')->get();
        $page = Page::query()->where('id', 3)->first();
        return view('web.page', compact('page'));

    }// end of index

    public function bank_accounts()
    {
        //$doctor_categories = DoctorCategory::orderby('id', 'asc')->get();
        $page = Page::query()->where('id', 5)->first();
        return view('web.page', compact('page'));

    }// end of index

    public function galleries()
    {
        $photos = Photo::all();
        return view('web.galleries', compact('photos'));

    }// end of index

    public function jobs()
    {
        return view('web.jobs');

    }// end of index

    public function videos()
    {
        $videos = Video::all();
        return view('web.videos', compact('videos'));

    }// end of index

    public function branches()
    {
        return view('web.branches');

    }// end of index

    public function contact_form(Request $request)
    {
        //dd($request);
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'visit_type' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = $request->all();

        Contact::create($data);

        session()->flash('contact_success', __('site.added_successfully'));
        //dd(session());
        return redirect(url()->previous() . '#contact-sent');

    }

    public function contact_service_form(Request $request, Service $service)
    {
        //dd($request);
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $data = $request->all();

        Contact::create($data);

        session()->flash('contact_success', __('site.added_successfully'));
        return redirect(url()->previous() . '#contact_form');

    }

    public function subscribe(Request $request)
    {
        request()->validate([
            'email' => 'required',
        ]);

        $data = $request->all();

        Subscribe::create($data);

        session()->flash('subscribe_success', __('site.added_successfully'));
        return redirect(url()->previous() . '#subscribe_form');

    }

    public function single_blog(Request $request, Blog $blog){
        return view('web.blog', compact('blog'));
    }

    public function single_campaign(Request $request, Campaign $campaign){
        //dd($campaign);
        return view('web.campaign', compact('campaign'));
    }

    public function single_campaign_complete(Request $request, Campaign $campaign){
        //dd($campaign);
        return view('web.campaign_completed', compact('campaign'));
    }

    public function page(Request $request, Page $page){
        return view('web.page', compact('page'));
    }

    public function payment(Request $request)
    {
        $data['amount'] = 1;
        $data['currency'] = 'USD';
        $data['customer'] = 'USD';

    }// end of payment

    public function showUserProfile(User $user)
    {

        //dd($user);

        //$appointments = Appointment::where('user_id', $user->id)->get();
        //dd($appointments);
        $this->middleware('role:user');
        if (Auth::user()->id === $user->id){
            return view('web.profile', compact('user'));
        }
        else{
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }


    }// end of payment

    public function category_show(Category $category)
    {
        $categories = Category::all();
        $blogs = Blog::where('category_id', '=', $category->id)->paginate(2);
        //return view('web.category', compact(['category', 'blogs', 'categories'] ));
        return view('web.blogs', compact(['category', 'blogs', 'categories'] ));

    }// end of delete

    public function addToCart($id)
    {
        //session()->flush();

        $campaign = Campaign::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $campaign->name,
            ];
        }
        session()->put('cart', $cart);

        //dd(session()->all());
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }// end of index

    function generateUniqueIdentifier()
    {
        return Str::uuid()->toString();
    }


    public function addToCartPost(Request $request)
    {

        session()->flush();
        $campaign = Campaign::find($request->campaignId);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart, $request->price);

        $cart->add($request->price, $campaign->id);

        $request->session()->put('cart', $cart);

        //dd($request->session()->get('cart'));

        //return redirect()->route('/');

        /*$campaign = Campaign::find($request->campaignId);

        $cart = session()->get('cart', []);

        $cart[$request->campaignId] = [

            'name' => $campaign->name,
            'price' => $request->price,

        ];
        session()->put('cart', $cart);

        dd(session()->get('cart'));*/

        /*---------------------------------------*/


        $user_id = (Auth::user() ? Auth::user()->id : null);
        $campaign_id = $request->campaignId;
        $price = $request->price;
        //$cookie_cart_identifier = $cookies[0]->getValue();
        $cookie_cart_identifier = rand(2,50);
        $input['campaign_id'] = $campaign_id;
        $input['status'] = false;
        $input['price'] = $price;
        $input['user_id'] = $user_id;
        //$input['quantity'] = UserCart::query()->where(['user_id'=>$user_id, 'campaign_id'=>$campaign_id])->where('status', 0)->count() + 1;
        $input['total_price'] = $input['price'];

        //dd($input);
        UserCart::updateOrCreate([
            'cookie_cart_identifier' => $cookie_cart_identifier,
            'status' => 0,
            'campaign_id' => $campaign_id
        ], $input);

        session()->flash('success', __('site.added_successfully'));
        session(['count' => self::cartCount($request)]);
        //return redirect()->route('campaigns');

        return response()->json([
            //'message'=> __('site.added_successfully_well'),
            'message'=> __('Başarıyla eklendi'),
            'count'=> self::cartCount($request),
        ]);

    }

    public function cart(){

        $userCarts = UserCart::query()->where('user_id', auth()->id())->where('status',0)->get();
        $totalPrice = UserCart::query()->where('user_id', auth()->id())->sum('total_price');

        return view('web.cart', compact('userCarts', 'totalPrice'));
    }

    public function cartRemove(Request $request){

        UserCart::findOrFail($request->userCartId)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        session(['count' => self::cartCount($request)]);
        //return redirect()->route('campaigns');

        return response()->json([
            'message'=> __('site.deleted_successfully'),
            'count'=> self::cartCount($request),
        ]);
    }

    public function cartQuantityUpdate(Request $request){

        //dd($request->all());
        UserCart::findOrFail($request->userCartId)->update(['quantity'=> $request->quantity,'total_price'=> $request->price * $request->quantity]);

        $totalPrice = UserCart::query()->where('user_id', auth()->id())->sum('total_price');
        session()->flash('success', __('site.updated_successfully'));
        session(['count' => self::cartCount($request)]);

        return response()->json([
            'message'=> __('site.updated_successfully'),
            'count'=> self::cartCount($request),
            'totalPrice'=> $totalPrice,
        ]);
    }

    public function checkout(){

        //dd($request->all());
        //$total = $request->totalPrice;
        $total = UserCart::query()->where('user_id', auth()->id())->sum('total_price');
        return view('web.checkout', compact('total'));
    }

    public function campaignCategory($id)
    {
        $campaigns = Campaign::where('c_category_id', $id)->paginate(8);
        $campaigns = Campaign::where('c_category_id', $id)->where('status', 'active')->where('complete', 'no')->with('category')->paginate(8);
        $category = CampaignCategory::where('id', $id)->first();
        //dd($category);
        return view('web.campaigns_category', compact(['campaigns', 'category'] ));

    }// end of delete

    public function said_about_us()
    {
        $page = Page::query()->where('id', 4)->first();
        return view('web.page', compact('page'));

    }// end of delete

    public function privacy()
    {
        $page = Page::query()->where('id', 1)->first();
        return view('web.page', compact('page'));

    }// end of delete

    public function terms_of_use()
    {
        $page = Page::query()->where('id', 2)->first();
        return view('web.page', compact('page'));

    }// end of delete

    public function donation_policy()
    {
        $page = Page::query()->where('id', 6)->first();
        return view('web.page', compact('page'));

    }// end of donation_policy

    public function delivery_and_refund()
    {
        $page = Page::query()->where('id', 7)->first();
        return view('web.page', compact('page'));

    }// end of donation_policy

    public function showPaymentFormLive(Request $request,$id)
    {

        return view('web.iyzico_payment_page');
        //$campaign = Campaign::where('id', $id)->with('category')->first();
        //dd($campaign);
        /*if (Auth::user()){
            $user = Auth::user();
        }else{
            $user = (object)array(
                "name"=>"guest",
                "email"=>"guestMail",
            );

        }*/

        $knet = KPayManager::make(100, [
            'user_id' => 1,
            'udf2' => 'guest',
            'udf3' => 'test@gmail.com',
        ]);

        // make KnetTransaction record in your database
        $payment = new Payment(
            KnetTransaction::create($knet->toArray())
        );
        return redirect($payment->actionUrl());
        //return $payment->actionUrl(); // redirect user to pay with url generated


        /*try{
            //dd($user->email);
            //$user = Auth::user();
            $payment = $user->pay($request->priceLive, [
                'udf1' => $campaign->id,
                'udf2' => 'guest',
                'udf3' => 'test@gmail.com',
            ]);

        } catch(\Asciisd\Knet\Exceptions\PaymentActionRequired $exception) {
            // do whatever you want with this
            $payment = $exception->payment;
        } finally {
            // redirect user to payment url to complete the payment
            dd($payment);
            if (isset($payment)){
                return redirect($payment->actionUrl());
            }else{
                return redirect('/');
            }
        }*/
    }

    public function showPaymentFormZakat(Request $request)
    {
        return view('web.iyzico_payment_page');
        //dd($request->typeOfDonate);
        try{
            $user = Auth::user();
            $payment = $user->pay($request->price, [
                'udf1' => 'zakat_page',
                'udf2' => $user->name,
                'udf3' => $user->email,
                'udf4' => $request->typeOfDonate,
            ]);
            //dd($payment);

        } catch(\Asciisd\Knet\Exceptions\PaymentActionRequired $exception) {
            // do whatever you want with this
            $payment = $exception->payment;
            //dd($payment);
        } finally {
            // redirect user to payment url to complete the payment
            //dd('aaaaaaaa');
            //dd($payment);
            if (isset($payment)){
                return redirect($payment->actionUrl());
            }else{
                return redirect('/');
            }
            //return redirect($payment->actionUrl());
        }
    }

    public function showPaymentForm(Request $request)
    {

        return view('web.iyzico_payment_page');
        $userCarts = UserCart::query()->where('user_id', auth()->id())->update(['status'=>1]);
        $totalPrice = UserCart::query()->where('user_id', auth()->id())->where('status',1)->sum('total_price');

        //dd($totalPrice);
        try{
            $user = Auth::user();
            $payment = $user->pay($totalPrice, [
                'udf1' => 0,
                'udf2' => $user->name,
                'udf3' => $user->email,
            ]);

        } catch(\Asciisd\Knet\Exceptions\PaymentActionRequired $exception) {
            // do whatever you want with this
            $payment = $exception->payment;
        } finally {
            // redirect user to payment url to complete the payment
            //dd('aaaaaaaa');
            if (isset($payment)){
                session(['count' => self::cartCount($request)]);
                return redirect($payment->actionUrl());

            }else{
                return redirect('/');
            }

        }
    }

    public function showPaymentFormBack(Request $request)
    {

        KnetResponseReceived::dispatch($request->all());

        $knetResponseHandler = new KPayResponseHandler();

        // find transaction by track id
        $transaction = KnetTransaction::findByTrackId($request->input('trackid'));

        // check if current response is duplicated and this transaction is already captured,
        // so don't update the transaction
        if ($knetResponseHandler->isDuplicated() && $transaction->isCaptured()) {
            $transaction->update($knetResponseHandler->errorsToArray());
            KnetTransactionHasErrors::dispatch($transaction);
            return $this->error($request);
        }

        // check if current response is invalid payment status and this transaction is already captured,
        // so don't update the transaction status
        if ($knetResponseHandler->isInvalidPaymentStatus() && $transaction->isCaptured()) {
            $transaction->update($knetResponseHandler->errorsToArray());
            KnetTransactionHasErrors::dispatch($transaction);
            return $this->error($request);
        }

        $transaction->update($knetResponseHandler->toArray());
        KnetTransactionUpdated::dispatch($transaction);
        KnetResponseHandled::dispatch($knetResponseHandler->toArray());

        $input['campaign_id'] = $transaction->udf1;
        $input['status'] = false;
        $input['price'] = $transaction->amt;
        $input['user_id'] = $transaction->user_id;
        $input['quantity'] = UserCart::query()->where(['user_id'=>$transaction->user_id, 'campaign_id'=>$transaction->udf1])->count() + 1;
        $input['total_price'] = $input['quantity']*$input['price'];



        //dd($transaction);
        UserCart::updateOrCreate([
            'user_id' => $transaction->user_id,
            'status' => 0,
            'campaign_id' => $transaction->udf1
        ], $input);

        $emailData = [
            'name' => 'Mohamad',
            'email' => 'mhmtslahyt68@gmail.com',
            'payment_id' => $transaction->paymentid,
            'track_id' => $transaction->trackid,
            'price' => $transaction->amt,
            'transaction_date' => $transaction->created_at,
        ];
        if ($transaction->auth_resp_code  == "00")

        \Illuminate\Support\Facades\Mail::to($emailData['email'])->send(new \App\Mail\PaymentConfirmation($emailData));
        else{
            \Illuminate\Support\Facades\Mail::to($emailData['email'])->send(new \App\Mail\PaymentError($emailData));
        }

        //dd($transaction);
        //return success
        return view('payment-form-knet', compact('transaction'));
        //return $this->successMethod();

        //$payment = $request->all();
        //dd($transaction);
        //return view('payment-form-knet', compact('payment'));
    }

    public function error(Request $request)
    {
        logger()->error('Knet error occurred with response data: ', $request->all());

        return $this->successMethod();
    }

    /**
     * Handle successful calls on the controller.
     *
     * @return RedirectResponse|Redirector|Response
     */
    protected function successMethod()
    {
        return redirect(
            url(config('knet.redirect_url'))
        );
    }

    /*public function paymentStatus(Request $request)
    {
        dd($request);
        if (isset($request)){
            return view('payment-form-knet');
        }else{
            return redirect('/');
        }

    }*/

    /*public function testMail()
    {
        // open an image file
        $imagePath = public_path('mail.png');

        $img = Image::make($imagePath);

        //$img->resize(320, 240);

        //$img->insert(public_path('favicon.ico'));

        //$img->save(public_path('new.png'));
        //dd($img);

        //$image = Image::make($imagePath);
        //dd($image);
        // Write the text on the image
        $img->text('Hello', 100, 100, function ($font) {
            //$font->file(public_path('web/fonts/fontawesome-webfont.woff'));
            $font->size(24);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('top');
        });

        // Save the modified image
        //$newImagePath = asset('img/new/mail.png');
        $img->save(public_path('new.png'));

        dd('done');

        // Return the path to the modified image or do any further processing
        //return $newImagePath;



        $emailData = [
            'name' => 'mhmt',
            'email' => 'mhmt@gmail.com',
        ];



        \Illuminate\Support\Facades\Mail::to($emailData['email'])->send(new \App\Mail\RegistrationConfirmation($emailData));

        //Mail::to($emailData['email'])->send(new RegistrationConfirmation($emailData));

        dd('done');
    }*/

}
