<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Coupon;

use Carbon\Carbon;

class CouponController extends Controller
{
    public function CouponView(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.view_coupon',compact('coupons'));
    }

    public function CouponStore(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_valdity' => 'required',
        ],[
            'coupon_name.required' => 'Input Coupon Name',
            'coupon_discount.required' => 'Input Coupon Discount',
            'coupon_valdity.required' => 'Input Coupon Valdity',
        ]);        

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_valdity' => $request->coupon_valdity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }

    public function CouponEdit($id){
        $coupons = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit',compact('coupons'));
    }

    public function CouponUpdate(Request $request){
        $coupon_id = $request->id;

        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_valdity' => $request->coupon_valdity,
            'updated_at' => Carbon::now(),
        ]);   
        $notification = array(
            'message' => 'Coupon Updated Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->route('manage-coupon')->with($notification);   
    }

    public function CouponDelete($id){

        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon Deleted Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }
}
