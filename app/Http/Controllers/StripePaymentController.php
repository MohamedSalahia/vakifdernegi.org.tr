<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\UserCart;
use App\Models\UserDonation;
use App\Traits\CartTrait;
use Illuminate\Http\Request;
use Session;

class StripePaymentController extends Controller
{

    use CartTrait;

    public function stripePost(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $userCarts = UserCart::query()->where('user_id', auth()->id())->update(['status'=>1]);
        $totalPrice = UserCart::query()->where('user_id', auth()->id())->where('status',1)->sum('total_price');


       $prices = [
         'price_data'=>[
             'currency' => 'usd',
             'product_data' => [
                 'name' => \auth()->user()->name
             ],
             'unit_amount' => $totalPrice * 100
         ],
        'quantity' => 1
       ];
        $response = $stripe->checkout->sessions->create([
            'success_url' => route('payment_success'),
            'cancel_url' => route('payment_cancel'),
            'line_items' => [
                $prices
            ],
            'mode' => 'payment',
        ]);
        session(['checkout_session_id'=>$response->id]);
        return redirect($response->url);
    }

    public function stripePostLive(Request $request,$id)
    {
        $price = $request->priceLive;

        $input['campaign_id'] = $id;
        $input['status'] = true;
        $input['price'] = $price;
        $input['user_id'] = auth()->user()->id;
        $input['quantity'] = UserCart::query()->where(['user_id'=>auth()->user()->id, 'campaign_id'=>$id])->count() + 1;
        $input['total_price'] = $input['quantity']*$input['price'];

        UserCart::updateOrCreate([
            'user_id' => auth()->user()->id,
            'status' => 0,
            'campaign_id' => $id
        ], $input);

        //dd('done');

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $prices = [
            'price_data'=>[
                'currency' => 'usd',
                'product_data' => [
                    'name' => \auth()->user()->name
                ],
                'unit_amount' => $price * 100
            ],
            'quantity' => 1
        ];
        $response = $stripe->checkout->sessions->create([
            'success_url' => route('payment_success'),
            'cancel_url' => route('payment_cancel'),
            'line_items' => [
                $prices
            ],
            'mode' => 'payment',
        ]);
        session(['checkout_session_id'=>$response->id]);
        return redirect($response->url);
    }

    public function paymentSuccess(Request $request){
        //dd(session('checkout_session_id'));
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $response = $stripe->checkout->sessions->retrieve(
            session('checkout_session_id'),[]
        );
        //dd($response);

        if ($response->payment_status == 'paid' && $response->status == 'complete' || $response->status == 'success'){
            $userCarts = UserCart::query()->where('user_id', auth()->id())->where('status',1)->get();

            foreach ($userCarts as $userCart){
                UserDonation::create([
                    'user_id'=>$userCart->user_id,
                    'campaign_id'=>$userCart->campaign_id,
                    'price'=>$userCart->price,
                    'total_price'=>$userCart->total_price,
                    'quantity'=>$userCart->quantity,
                ]);
            }
            $userCarts = UserCart::query()->where('user_id', auth()->id())->where('status',1)->delete();

            session(['count' => self::cartCount()]);
            session()->forget('checkout_session_id');
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('campaigns');
        }

    }
    public function paymentCancel(Request $request){
        session()->flash('danger', __('site.cancel_successfully'));
        return redirect()->route('campaigns');
    }
}
