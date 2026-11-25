<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Asciisd\Knet\Payment;
use Asciisd\Knet;

class KnetPaymentController extends Controller
{



    public function initiatePayment(Request $request)
    {
        $payment = new Payment();
        $payment->setAmount(10)
            ->setResourceKey(env('KENT_RESOURCE_KEY'))
            ->setCurrency('KWD')
            ->setLanguage('ENG')
            ->setAction('1')
            ->setResponseUrl(route('payment.response'))
            ->setErrorUrl(route('payment.error'))
            ->setTrackId(env('KNET_TERMINAL_RESOURCE_KEY'))
            ->setUdf1('your-custom-field-1')
            ->setUdf2('your-custom-field-2')
            ->setUdf3('your-custom-field-3');

        $form = $payment->generateForm();
    }

    public function paymentResponse(Request $request)
    {
        dd('paymentResponse');
        $client = new \GuzzleHttp\Client();

        $response = $client->post(config('knet.base_url') . 'API/Action', [
            'form_params' => [
                'TranPortalId' => env('KNET_TRAN_PORTAL_ID'),
                'TranPortalPassword' => env('KNET_TRAN_PORTAL_ID'),
                'TerminalResourceId' => env('KNET_TRAN_PORTAL_ID'),
                'TrackId' => $request->input('trackid'),
                'PaymentId' => $request->input('paymentid'),
                'Udf1' => $request->input('udf1'),
                'Udf2' => $request->input('udf2'),
                'Udf3' => $request->input('udf3'),
                'Udf4' => $request->input('udf4'),
                'Udf5' => $request->input('udf5'),
                'Action' => '2',
            ],
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        if ($responseData['Result'] != 'Success') {
            // Handle error
        }

        // Payment was successful
        // Get payment details from the response and update the order status in your database
        $paymentId = $responseData['PaymentId'];
        $orderId = $responseData['Udf1'];
        $amount = $responseData['Amount'];

        // Update the order status in your database
        $order = Order::find($orderId);
        $order->status = 'completed';
        $order->payment_method = 'Knet';
        $order->payment_transaction_id = $paymentId;
        $order->payment_amount = $amount;
        $order->save();

        // Redirect the user to the thank you page
        return redirect()->route('thank-you');
    }

    // Payment error handling function
    public function paymentError(Request $request)
    {
        dd('paymentError');
        // Handle the payment error
        $errorCode = $request->input('errorcode');
        $errorMessage = $request->input('errormessage');

        // Log the error and display an error message to the user
        Log::error("Knet payment error: [$errorCode] $errorMessage");
        return view('payment.error')->with('errorMessage', $errorMessage);
    }


}
