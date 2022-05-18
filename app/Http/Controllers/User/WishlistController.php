<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function viewWishlist(){
        return view('frontend.wishlist.view_wishlist');
    }

    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($wishlist);
    }
}
