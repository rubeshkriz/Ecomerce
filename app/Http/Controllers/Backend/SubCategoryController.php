<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_view', compact('subcategory','categories'));
    }
        
    public function SubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_hin' => 'required',
        ],[
            'category_id.required' => 'Pls Select Any Option',
            'subcategory_name_en.required' => 'Input SubCategory English',
            'subcategory_name_hin.required' => 'Input SubCategory Hindi',
        ]);        

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ' , '-',$request->subcategory_name_en)),
            'subcategory_slug_hin' => strtolower(str_replace(' ' , '-',$request->subcategory_name_hin)),
        ]);

        $notification = array(
            'message' => 'Sub Category Inserted Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit',compact('subcategory', 'categories'));
    }

    public function SubCategoryUpdate(Request $request){

        $subcat_id = $request->id;        

        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ' , '-',$request->subcategory_name_en)),
            'subcategory_slug_hin' => strtolower(str_replace(' ' , '-',$request->subcategory_name_hin)),
        ]);

        $notification = array(
            'message' => 'Sub Category Updated Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->route('all.subcategory')->with($notification);
    }

    public function SubCategoryDelete($id){
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }

    //////////////////////////////Thats for Sub Sub Categories /////////////////////////////////

    public function SubSubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.subsubcategory.subsubcategory_view', compact('subsubcategory','categories'));
    }

    ///////////////////Ajax Route////////////////
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }
    /////////////////////////////////////////////

    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_hin' => 'required',
        ],[
            'category_id.required' => 'Pls Select Any Option',
            'subcategory_id.required' => 'Pls Select Any Option',
            'subcategory_name_en.required' => 'Input SubCategory English',
            'subcategory_name_hin.required' => 'Input SubCategory Hindi',
        ]);        

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ' , '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => strtolower(str_replace(' ' , '-',$request->subsubcategory_name_hin)),
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Inserted Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);
        return view('backend.subsubcategory.subsubcategory_edit',compact('categories', 'subcategories', 'subsubcategories'));
    }

    public function SubSubCategoryUpdate(Request $request){

        $subsubcat_id = $request->id;        

        SubSubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ' , '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => strtolower(str_replace(' ' , '-',$request->subsubcategory_name_hin)),
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Updated Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function SubSubCategoryDelete($id){

        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub Sub Category Deleted Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }

    
}
