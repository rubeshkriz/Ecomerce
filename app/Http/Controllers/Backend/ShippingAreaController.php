<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ShipDivision;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function DivisionView(){
        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.ship.division.view_division',compact('divisions'));
    }

    public function DivisionStore(Request $request){
        $request->validate([
            'division_name' => 'required',
        ],[
            'division_name.required' => 'Input Division Name',
        ]);        

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipDivision Inserted Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }

    public function DivisionEdit($id){
        $divisions = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division',compact('divisions'));
    }

    public function DivisionUpdate(Request $request){
        $division_id = $request->id;

        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
            'updated_at' => Carbon::now(),
        ]);   
        $notification = array(
            'message' => 'Ship Division Updated Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->route('manage-division')->with($notification);   
    }

    public function DivisionDelete($id){

        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Ship Division Deleted Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }
}
