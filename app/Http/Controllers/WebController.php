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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\View;
use Auth;
use Session;
use Intervention\Image\Facades\Image;
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


    public function contact()
    {
        return view('web.contact_us');

    }// end of index

    public function about()
    {
        //$doctor_categories = DoctorCategory::orderby('id', 'asc')->get();
        $page = Page::query()->where('id', 3)->firstOrFail();
        return view('web.page', compact('page'));

    }// end of index

    public function bank_accounts()
    {
        if (!config('donation.bank_transfer_enabled')) {
            // IBANs not verified yet: never show unverified accounts to donors.
            $page = (object) [
                'name' => __('site.bank_accounts'),
                'description' => '<p style="padding:40px 0;text-align:center">' . e(__('site.bank_info_unavailable')) . '</p>',
            ];
            return view('web.page', compact('page'));
        }

        $page = Page::query()->where('id', 5)->firstOrFail();
        return view('web.page', compact('page'));

    }// end of index





    public function contact_form(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'required|string|max:30',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:5000',
            'kvkk'    => 'accepted',
        ]);
        unset($data['kvkk']);
        $data['visit_type'] = 'new_visit'; // legacy NOT NULL column from the old template

        Contact::create($data);

        session()->flash('contact_success', __('site.added_successfully'));
        //dd(session());
        return redirect(url()->previous() . '#contact-sent');

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


    public function campaignCategory($id)
    {
        $campaigns = Campaign::where('c_category_id', $id)->paginate(8);
        $campaigns = Campaign::where('c_category_id', $id)->where('status', 'active')->where('complete', 'no')->with('category')->paginate(8);
        $category = CampaignCategory::where('id', $id)->firstOrFail();
        //dd($category);
        return view('web.campaigns_category', compact(['campaigns', 'category'] ));

    }// end of delete


    public function privacy()
    {
        $page = Page::query()->where('id', 1)->firstOrFail();
        return view('web.page', compact('page'));

    }// end of delete

    public function terms_of_use()
    {
        $page = Page::query()->where('id', 2)->firstOrFail();
        return view('web.page', compact('page'));

    }// end of delete

    public function donation_policy()
    {
        $page = Page::query()->where('id', 6)->firstOrFail();
        return view('web.page', compact('page'));

    }// end of donation_policy

    public function delivery_and_refund()
    {
        $page = Page::query()->where('id', 7)->firstOrFail();
        return view('web.page', compact('page'));

    }// end of donation_policy
}
