<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\ShippingChargeController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as Product;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/admin', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/create', [CategoryController::class, 'create']);
    Route::post('admin/category/store', [CategoryController::class, 'store']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::put('admin/category/edit/{id}', [CategoryController::class, 'update']);
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'destroy']);

    Route::get('admin/subcategory', [SubCategoryController::class, 'index']);
    Route::get('admin/subcategory/create', [SubCategoryController::class, 'create']);
    Route::post('admin/subcategory/store', [SubCategoryController::class, 'store']);
    Route::get('admin/subcategory/edit/{id}', [SubCategoryController::class, 'edit']);
    Route::put('admin/subcategory/edit/{id}', [SubCategoryController::class, 'update']);
    Route::get('admin/subcategory/delete/{id}', [SubCategoryController::class, 'destroy']);
    Route::post('admin/getsubcategory', [SubCategoryController::class, 'getsubcategory']);

    Route::get('admin/brand', [BrandController::class, 'index']);
    Route::get('admin/brand/create', [BrandController::class, 'create']);
    Route::post('admin/brand/store', [BrandController::class, 'store']);
    Route::get('admin/brand/edit/{id}', [BrandController::class, 'edit']);
    Route::put('admin/brand/edit/{id}', [BrandController::class, 'update']);
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'destroy']);

    Route::get('admin/product', [ProductController::class, 'index']);
    Route::get('admin/product/create', [ProductController::class, 'create']);
    Route::post('admin/product/store', [ProductController::class, 'store']);
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('admin/product/edit/{id}', [ProductController::class, 'update']);
    Route::get('admin/product/delete/{id}', [ProductController::class, 'destroy']);
    Route::get('admin/product/image_delete/{id}', [ProductController::class, 'image_delete']);
    Route::post('admin/product_image_sortable', [ProductController::class, 'product_image_sortable']);
   
    Route::get('admin/color', [ColorController::class, 'index']);
    Route::get('admin/color/create', [ColorController::class, 'create']);
    Route::post('admin/color/store', [ColorController::class, 'store']);
    Route::get('admin/color/edit/{id}', [ColorController::class, 'edit']);
    Route::put('admin/color/edit/{id}', [ColorController::class, 'update']);
    Route::get('admin/color/delete/{id}', [ColorController::class, 'destroy']);

    Route::get('admin/discountcode', [DiscountCodeController::class, 'index']);
    Route::get('admin/discountcode/create', [DiscountCodeController::class, 'create']);
    Route::post('admin/discountcode/store', [DiscountCodeController::class, 'store']);
    Route::get('admin/discountcode/edit/{id}', [DiscountCodeController::class, 'edit']);
    Route::put('admin/discountcode/edit/{id}', [DiscountCodeController::class, 'update']);
    Route::get('admin/discountcode/delete/{id}', [DiscountCodeController::class, 'destroy']);

    Route::get('admin/shippingcharge', [ShippingChargeController::class, 'index']);
    Route::get('admin/shippingcharge/create', [ShippingChargeController::class, 'create']);
    Route::post('admin/shippingcharge/store', [ShippingChargeController::class, 'store']);
    Route::get('admin/shippingcharge/edit/{id}', [ShippingChargeController::class, 'edit']);
    Route::put('admin/shippingcharge/edit/{id}', [ShippingChargeController::class, 'update']);
    Route::get('admin/shippingcharge/delete/{id}', [ShippingChargeController::class, 'destroy']);
});

Route::get('/', [HomeController::class, 'index']);
Route::post('auth_register', [AuthController::class, 'auth_register']);
Route::post('auth_login', [AuthController::class, 'auth_login']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot_password', [AuthController::class, 'forgot_password']);
Route::post('auth_forgot_password', [AuthController::class, 'auth_forgot_password']);

Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'auth_reset']);

Route::get('activate/{id}', [AuthController::class, 'activate_email']);

Route::get('cart', [PaymentController::class, 'cart']);
Route::post('updatecart', [PaymentController::class, 'update_cart']);
Route::get('cart/delete/{id}', [PaymentController::class, 'cart_delete']);

Route::get('checkout', [PaymentController::class, 'checkout']);
Route::post('checkout/apply_discount_code', [PaymentController::class, 'apply_discount_code']);

Route::post('product/add-to-cart', [PaymentController::class, 'add_to_cart']);

Route::get('search', [Product::class, 'getProductSearch']);

Route::post('productsfilter', [Product::class, 'productsFilter']);
Route::get('{category?}/{subcategory?}', [Product::class, 'getCategory']);