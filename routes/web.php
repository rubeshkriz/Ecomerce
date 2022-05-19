<?php

use App\Models\User;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;

use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//AdminAuthRoute

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');
});

Route::middleware(['auth:admin'])->group(function(){

////////////////////////////////////////////////////////////////////////////////
//Admin All Routes
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

////////////////////////////////////////////////////////////////////////////////
//Admin BRAND All Routes
Route::prefix('brand')->group(function(){
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});

////////////////////////////////////////////////////////////////////////////////
//Admin Category All Routes
Route::prefix('category')->group(function(){
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
});

////////////////////////////////////////////////////////////////////////////////
//Admin Sub Category All Routes
Route::prefix('category')->group(function(){
    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');
});

////////////////////////////////////////////////////////////////////////////////
//Admin Sub Sub Category All Routes
Route::prefix('category')->group(function(){
    Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');
        
        ///////Ajax////
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
        /////End-Ajax////

    Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');

});

///////////////////////////////////////////////////////////////////////add-product/////////
//Admin Product All Routes
Route::prefix('product')->group(function(){
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');    
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');   
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');    
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');    
    Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');   
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');   
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');   
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');

    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');    
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');    
});

////////////////////////////////////////////////////////////////////////////////
//Admin Slider All Routes
Route::prefix('slider')->group(function(){
    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');

    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');    
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');  
});

////////////////////////////////////////////////////////////////////////////////
//Admin Coupon All Routes
Route::prefix('coupons')->group(function(){
    Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
    Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
    Route::post('/update', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
    Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
});

////////////////////////////////////////////////////////////////////////////////
//Admin Shipping Devision All Routes
Route::prefix('shipping')->group(function(){
    Route::get('/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
    Route::post('/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
    Route::get('/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
    Route::post('/update', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
    Route::get('/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');
});

////////////////////////////////////////////////////////////////////////////////
//Admin Shipping District All Routes
Route::prefix('shipping')->group(function(){
    Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');
    Route::post('/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
    Route::get('/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
    Route::post('/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
    Route::get('/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');
});

});////////////////////////////////////////////////////////Admin AUTH Middleware END

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////User All Routes
Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');



////////////////////////////////////////////////////////////////////////////////
//DefaultAuthRoute
Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
        Route::get('/dashboard', function () {

            $id = Auth::user()->id;
            $user = User::find($id);

        return view('dashboard',compact('user'));
    })->name('dashboard');
});


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////FRONT END ALL ROUTES///////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////
///////////MULTI LANGUAGE ALL ROUTES
Route::get('/language/hindi', [LanguageController::class, 'Hindi'])->name('hindi.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

///////////////////////////////////////////////////////////////////////////////////
///////////FrontEnd Product routes
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']); ///Tags

Route::get('subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']); ///SubCategoryWise
Route::get('subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']); ///SubSubCategoryWise

//////Product View "AJAX"////////
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']); ///Product Ajax

//////ADD TO CART "AJAX"////////
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']); ///Cart Ajax

//////ADD TO MINI -- CART "AJAX"////////
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']); ///Mini Cart Ajax

//////REMOVE TO MINI -- CART "AJAX"////////
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']); ///Mini Cart Ajax

//////Wish List////////
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']); 

/////////////////////////////////////////////////////////////////////////////////
//////////////////////////Prevent BY Authorization
Route::group(['prefix'=>'user','middleware'=>['user','auth'],'namespace'=>'user'],

    function(){
        Route::get('/wishlist/', [WishlistController::class, 'viewWishlist'])->name('wishlist'); 
        Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']); 
        Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']); 
    }
);

///////////////////MyCart Routes
Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart'); 
Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']); 
Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']); 
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']); 
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']); 

