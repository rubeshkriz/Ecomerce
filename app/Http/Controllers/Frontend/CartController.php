<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



use Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;


use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Coupon;
use App\Models\ShipDivision;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function AddToCart(Request $request, $id){

        if(Session::has('coupon')){
            Session::forgot('coupon');
        }

        $product = Product::findOrFail($id);

        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id, 
                'name' => $request->product_name, 
                'qty' => $requet->quantity, 
                'price' => $product->selling_price, 
                'weight' => 550, 
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => "Sucessfully Added On Your Cart"]);
        }else{
            Cart::add([
                'id' => $id, 
                'name' => $request->product_name, 
                'qty' => $request->quantity, 
                'price' => $product->discount_price, 
                'weight' => 550, 
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => "Sucessfully Added On Your Cart"]);
        }
    }

    ///Mini Cart Section
    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));

    }//end Method

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed From Cart']);
    }//end Method

    public function AddToWishlist(Request $request,$product_id){
        if(Auth::check()){
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if(!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
    
                return response()->json(['success' => 'Wishlist Added Sucessfully']);
            }else{
                return response()->json(['error' => 'This product Already in Wishlist']);
            }



        }else{
            return response()->json(['error' => 'plz Login Your Account']);
        }
    }//end Method

    public function CouponApply(Request $request){
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_valdity','>=',Carbon::now()->format('Y-m-d'))->first();

        if($coupon){
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);

            return response()->json(array(
                'success' => 'Coupon Appy Successfully'
            ));
        }else{
            return response()->json(['error'=>'Invalid Coupon']);
        }
    }

    public function CouponCalculation(){
        if(Session::has('coupon')){
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    public function CouponRemove(){
        ///Remove Coupon Data IN SESSION
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);
    }

    //////Checkout
    public function CheckoutCreate(){
        if(Auth::check()){
            if(Cart::total() > 0){

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBy('division_name','ASC')->get();

                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));
            }else{
                $notification = array(
                    'message' => 'Shop Atleast One Product To Checkout',
                    'alert-type' => 'error'
                );       
                return redirect()->to('/')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'You Need To Login First',
                'alert-type' => 'error'
            );       
            return redirect()->route('login')->with($notification);
        }
    }



}
