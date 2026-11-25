<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TapController extends Controller
{
    public function form()
    {
        return view('tap-payment');
    }

    public function payment(Request $request)
    {
        $request = $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'currency' => 'required',
            'amount' => 'required|numeric',
            'order_id' => 'required',
            'phone' => 'required|numeric'
        ]);

        $payment = [
            "amount" => round($request['amount'],2),
            "description" =>  'Hello '. $request['first_name'].' '.$request['last_name'].' Your order_id is '.$request['order_id'].' please pay and confirm your order Thanks For made order.',
            "currency" => $request['currency'],
            "receipt" => [
                "email" => true,
                "sms" => true
            ],
            "customer"=> [
                "first_name"=> $request['first_name'],
                "last_name"=> $request['last_name'],
                "email"=> $request['email'],
                "phone"=> [
                    "country_code" => 'IN',
                    "number" => $request['phone']
                ]
            ],
            "source"=> [
                "id"=> "src_card"
            ],
            "redirect"=> [
                "url"=> route('tap.callback')
            ]
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/charges",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payment),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer REDACTED", // SECRET API KEY
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);

        return redirect($response->transaction->url);
    }

    public function callback(Request $request)
    {
        $input = $request->all();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/charges/".$input['tap_id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer REDACTED" // SECRET API KEY
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $responseTap = json_decode($response);

        if ($responseTap->status == 'CAPTURED') {

            return redirect()->route('tap.form')->with('success','Payment Successfully Made.');
        }

        return redirect()->route('tap.form')->with('error','Something Went Wrong.');
    }
}
