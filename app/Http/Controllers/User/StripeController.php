<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){

        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        // \Stripe\Stripe::setApiKey('sk_test_51L1kwFSFUihgswnJaJkcuupfAJMHwidrlkjCVh3Ri5l1juTxdcQjVHBXOGItQOKwonq4qm2BRgJv3tMoPvwOLyeL00MzOPQkJs');
        // $token = $_POST['stripeToken'];

        // $charge = \Stripe\Charge::create([
        // 'amount' => 999*100,
        // 'currency' => 'usd',
        // 'description' => 'Easy Online Store',
        // 'source' => $token,
        // 'metadata' => ['order_id' => '6735'],
        // ]);

        $stripe = new \Stripe\StripeClient('sk_test_51L1kwFSFUihgswnJaJkcuupfAJMHwidrlkjCVh3Ri5l1juTxdcQjVHBXOGItQOKwonq4qm2BRgJv3tMoPvwOLyeL00MzOPQkJs');

        $charge = $stripe->paymentIntents->create(
            [
              'amount' => 1099*100,
              'currency' => 'usd',
              'description' => 'Easy Online Shop',
            ]
          );

        dd($charge);


    }
}
