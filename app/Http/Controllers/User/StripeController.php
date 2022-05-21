<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\orderMail;


class StripeController extends Controller
{
    public function StripeOrder(Request $request){

      if(Session::has('coupon')){
        $total_amount = Session::get('coupon')['total_amount'];
      }else{
        $total_amount = round(Cart::total());
      }

        $stripe = new \Stripe\StripeClient('sk_test_51L1kwFSFUihgswnJaJkcuupfAJMHwidrlkjCVh3Ri5l1juTxdcQjVHBXOGItQOKwonq4qm2BRgJv3tMoPvwOLyeL00MzOPQkJs');

        $charge = $stripe->paymentIntents->create(
            [
              'amount' => $total_amount*100,
              'currency' => 'usd',
              'description' => 'Easy Online Shop',
              'metadata' => ['order_id' => uniqid()],
            ]
          );

        // dd($charge);

        $order_id = Order::insertGetId([
          'user_id' => Auth::id(),
          'division_id' => $request->division_id,
          'district_id' => $request->district_id,
          'state_id' => $request->state_id,
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'post_code' => $request->post_code,
          'notes' => $request->notes,

          'payment_type' => 'Stripe',          
          'payment_method' => 'Stripe',

          'transection_id' => $charge->balance_transaction,

          'currency' => $charge->currency,
          'amount' => $total_amount,
          'order_number' => $charge->metadata->order_id,
          'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
          'order_date' => Carbon::now()->format('d F Y'),
          'order_month' => Carbon::now()->format('F'),
          'order_year' => Carbon::now()->format('Y'),
          'status' => 'Pending',
          'created_at' => Carbon::now(),
        ]);

        /////////    regestering Email Start              ///////////////
          $invoice = Order::findOrFail($order_id);
          $data = [
            "invoice_no" =>  $invoice->invoice_no,
            "amount" =>  $total_amount,
            "name" =>  $invoice->name,
            "email" => $invoice->email,
          ];

          Mail::to($request->email)->send(new OrderMail($data));

        /////////      regestering Email End             ///////////////


        $carts = Cart::content();
        foreach($carts as $cart){
          OrderItem::insert([
            'order_id' => $order_id,
            'product_id' => $cart->id,
            'color' => $cart->options->color,
            'size' => $cart->options->size,
            'qty' => $cart->qty,
            'price' => $cart->price,
            'created_at' => Carbon::now(),
          ]);
        }

        if(Session::has('coupon')){
          Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
          'message' => 'Your Order Placed Sucessfully',
          'alert-type' => 'success'
      );       
      return redirect()->route('dashboard')->with($notification);   
    }



}
