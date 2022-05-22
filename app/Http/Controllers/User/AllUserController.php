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

use App\Mail\orderMail;

class AllUserController extends Controller
{
    public function MyOrders(){
        $orders = Order::with('division','district','state','user')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_view',compact('orders'));
    }

    public function OrderDetails($order_id){
        $order = Order::where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('frontend.user.order.order_details',compact('order','orderItem'));

    }
}
