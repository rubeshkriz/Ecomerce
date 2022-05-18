<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
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

    public function AddToWishlist(Requesst $request,$product_id){
        
    }//end Method



}
