<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
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


    /////////////////////////////Start Ship District///////////////////////

    public function DistrictView(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('backend.ship.district.view_district',compact('division','district'));
    }

    public function DistrictStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ],[
            'division_id.required' => 'Input Division Name',
            'district_name.required' => 'Input District Name',
        ]);        

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipDistrict Inserted Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }

    public function DistrictEdit($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district',compact('division','district'));
    }

    public function DistrictUpdate(Request $request,$id){

        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'updated_at' => Carbon::now(),
        ]);   
        $notification = array(
            'message' => 'Ship District Updated Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->route('manage-district')->with($notification);   
    }

    public function DistrictDelete($id){

        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Ship District Deleted Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }

    /////////////////////////////End Ship District///////////////////////

    /////////////////////////////Start Ship Stae///////////////////////

    public function StateView(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::with('division','district')->orderBy('id','DESC')->get();
        return view('backend.ship.state.view_state',compact('division','district','state'));
    }

    public function StateStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ],[
            'division_id.rdistrict_idequired' => 'Input Division Name',
            'district_id.required' => 'Input District Name',
            'state_name.required' => 'Input State Name',
        ]);        

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipState Inserted Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }

    public function StateEdit($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state',compact('division','district','state'));
    }

    public function StateUpdate(Request $request,$id){

        ShipState::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'updated_at' => Carbon::now(),
        ]);   
        $notification = array(
            'message' => 'Ship State Updated Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->route('manage-state')->with($notification);   
    }
    
    public function StateDelete($id){

        ShipState::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Ship State Deleted Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }

    /////////////////////////////End Ship Stae///////////////////////
    
}
