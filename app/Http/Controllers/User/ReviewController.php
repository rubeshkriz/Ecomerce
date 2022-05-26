<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Auth;

use App\Models\Review;

class ReviewController extends Controller
{
    public function ReviewStore(Request $request){
        $product = $request->product_id;

        $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Review Will Approve By Admin',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }

    public function PendingReview(){
        $review = Review::where('status',0)->orderBy('id','DESC')->get();
        return view('backend.review.pending_review',compact('review'));
    }

    public function ReviewApprove($id){
        Review::where('id',$id)->update(['status' => 1]);

        $notification = array(
            'message' => 'review Approved Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);   
    }

    public function PublishReview(){
        $review = Review::where('status',1)->orderby('id','DESC')->get();
        return view('backend.review.publish_review',compact('review'));
    }

    public function DeleteReview($id){
        Review::findOrFail($id)->delete();

        $notification = array(
            'message' => 'review Deleted Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }


}
