<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HyperpayController extends Controller
{
    public function form()
    {
        return view('hyperpay-payment');
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

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=REDACTED" .
                    "&amount=".$request->amount .
                    "&currency=".$request->currency .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer REDACTED'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $response = json_decode($responseData, true);

        // return redirect($response->transaction->url);
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
