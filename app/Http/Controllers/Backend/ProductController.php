<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;

use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function Addproduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add',compact('categories','brands'));
    }    

    public function StoreProduct(Request $request){

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;           

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_hin' => $request->product_name_hin,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_hin' => strtolower(str_replace(' ', '-', $request->product_name_hin)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_hin' => $request->product_tags_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_hin' => $request->short_descp_hin,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_hin' => $request->long_descp_hin,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thambnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),            
        ]);

        /////////////////// Multiple Image Upload Start /////////////////////////

        $images = $request->file('multi_img');
        foreach ($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;
            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        /////////////////// Multiple Image Upload End ///////////////////////////

        $notification = array(
            'message' => 'Product Inserted Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->route('manage-product')->with($notification);
    }

    public function ManageProduct(){
        $products = Product::latest()->get();
        return view('backend.product.product_view',compact('products'));
    }

    public function EditProduct($id){
        
        $multiImgs = MultiImg::where('product_id',$id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);

        return view('backend.product.product_edit',compact('categories','brands','subcategories','subsubcategories','products', 'multiImgs'));
    }

    public function ProductDataUpdate(Request $request){
        $product_id = $request->id;
        Product::findOrfail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_hin' => $request->product_name_hin,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_hin' => strtolower(str_replace(' ', '-', $request->product_name_hin)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_hin' => $request->product_tags_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_hin' => $request->short_descp_hin,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_hin' => $request->long_descp_hin,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'updated_at' => Carbon::now(),            
        ]);

        $notification = array(
            'message' => 'Product Updated Without IMAGE Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->route('manage-product')->with($notification);

    }

    // Multiple image Update
    public function MultiImageUpdate(Request $request){
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);
            
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $upload_path = 'upload/products/multi-image/'.$make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $upload_path,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Multiple Image Updated Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }

    //Thambnail Image Update
    public function ThambnailImageUpdate(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Thambnail Image Updated Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }

    //Multi Image Delete
    public function MultiImageDelete($id){
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);

        MultiImg::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product Image Deleted Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }

    //Product In active
    public function ProductInactive($id){
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product InActive Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }

    //Product active
    public function ProductActive($id){
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active Sucessfully',
            'alert-type' => 'success'
        );       
        return redirect()->back()->with($notification);
    }

    //Product Delete
    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

        $image = MultiImg::where('product_id',$id)->get();
        foreach ($image as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id',$id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Sucessfully',
            'alert-type' => 'info'
        );       
        return redirect()->back()->with($notification);
    }



}
