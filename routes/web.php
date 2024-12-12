<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\ShippingChargeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as Product;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

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


Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [UserController::class, 'dashboard']);
    Route::get('user/orders', [UserController::class, 'orders']);
    Route::get('user/orders/detail/{id}', [UserController::class, 'order_detail']);
    Route::get('user/edit-profile', [UserController::class, 'edit_profile']);
    Route::post('user/edit-profile', [UserController::class, 'update_profile']);
    Route::get('user/change-password', [UserController::class, 'change_password']);
    Route::post('user/change-password', [UserController::class, 'update_password']);
    Route::get('user/notifications', [UserController::class, 'notifications']);
    
    Route::post('user/add_to_wishlist', [UserController::class, 'add_to_wishlist']);
    Route::get('wishlist', [Product::class, 'wishlist']);
    Route::post('user/make-review', [UserController::class, 'make_review']);

    Route::post('blog/submit_comment', [HomeController::class, 'comment']);
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/admin', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    Route::get('admin/customers', [AdminController::class, 'customers']);
    Route::get('admin/customers/delete/{id}', [AdminController::class, 'delete_customer']);

    Route::get('admin/orders', [OrderController::class, 'index']);
    Route::get('admin/orders/detail/{id}', [OrderController::class, 'show']);
    Route::get('admin/orders/orders_status', [OrderController::class, 'orders_status']);

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

    Route::get('admin/page', [PageController::class, 'index']);
    Route::get('admin/page/edit/{id}', [PageController::class, 'edit']);
    Route::put('admin/page/edit/{id}', [PageController::class, 'update']);

    Route::get('admin/settings', [PageController::class, 'settings']);
    Route::post('admin/settings', [PageController::class, 'update_settings']);
    
    Route::get('admin/home-setting', [PageController::class, 'home_settings']);
    Route::post('admin/home-setting', [PageController::class, 'home_update_settings']);
    
    Route::get('admin/smtp-setting', [PageController::class, 'smtp_settings']);
    Route::post('admin/smtp-setting', [PageController::class, 'smtp_update_settings']);

    Route::get('admin/contactus', [ContactUsController::class, 'index']);
    Route::get('admin/contactus/delete/{id}', [ContactUsController::class, 'destroy']);

    Route::get('admin/slider', [SliderController::class, 'index']);
    Route::get('admin/slider/create', [SliderController::class, 'create']);
    Route::post('admin/slider/store', [SliderController::class, 'store']);
    Route::get('admin/slider/edit/{id}', [SliderController::class, 'edit']);
    Route::put('admin/slider/edit/{id}', [SliderController::class, 'update']);
    Route::get('admin/slider/delete/{id}', [SliderController::class, 'destroy']);

    Route::get('admin/partner', [PartnerController::class, 'index']);
    Route::get('admin/partner/create', [PartnerController::class, 'create']);
    Route::post('admin/partner/store', [PartnerController::class, 'store']);
    Route::get('admin/partner/edit/{id}', [PartnerController::class, 'edit']);
    Route::put('admin/partner/edit/{id}', [PartnerController::class, 'update']);
    Route::get('admin/partner/delete/{id}', [PartnerController::class, 'destroy']);

    Route::get('admin/blogcategory', [BlogCategoryController::class, 'index']);
    Route::get('admin/blogcategory/create', [BlogCategoryController::class, 'create']);
    Route::post('admin/blogcategory/store', [BlogCategoryController::class, 'store']);
    Route::get('admin/blogcategory/edit/{id}', [BlogCategoryController::class, 'edit']);
    Route::put('admin/blogcategory/edit/{id}', [BlogCategoryController::class, 'update']);
    Route::get('admin/blogcategory/delete/{id}', [BlogCategoryController::class, 'destroy']);

    Route::get('admin/blog', [BlogController::class, 'index']);
    Route::get('admin/blog/create', [BlogController::class, 'create']);
    Route::post('admin/blog/store', [BlogController::class, 'store']);
    Route::get('admin/blog/edit/{id}', [BlogController::class, 'edit']);
    Route::put('admin/blog/edit/{id}', [BlogController::class, 'update']);
    Route::get('admin/blog/delete/{id}', [BlogController::class, 'destroy']);

    Route::get('admin/notifications', [NotificationController::class, 'index']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('contact', [HomeController::class, 'contact']);
Route::post('contact', [HomeController::class, 'save_contact']);
Route::get('about', [HomeController::class, 'about']);
Route::get('faq', [HomeController::class, 'faq']);
Route::get('payment-methods', [HomeController::class, 'payment_methods']);
Route::get('money-back-guarantee', [HomeController::class, 'money_back_guarantee']);
Route::get('returns', [HomeController::class, 'returns']);
Route::get('shipping', [HomeController::class, 'shipping']);
Route::get('terms-conditions', [HomeController::class, 'terms_conditions']);
Route::get('privacy-policy', [HomeController::class, 'privacy_policy']);
Route::get('blog', [HomeController::class, 'blog']);
Route::get('blog/category/{slug}', [HomeController::class, 'categories']);
Route::get('blog/{url}', [HomeController::class, 'blogdetail']);

Route::post('recent_arrivals_product', [HomeController::class, 'recent_arrivals_product']);

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
Route::post('checkout/place_order', [PaymentController::class, 'place_order']);
Route::get('checkout/payment', [PaymentController::class, 'checkout_payment']);
Route::get('paypal/success-payment', [PaymentController::class, 'paypal_success_payment']);
Route::get('stripe/payment-success', [PaymentController::class, 'stripe_success_payment']);

Route::post('product/add-to-cart', [PaymentController::class, 'add_to_cart']);

Route::get('search', [Product::class, 'getProductSearch']);

Route::post('productsfilter', [Product::class, 'productsFilter']);
Route::get('{category?}/{subcategory?}', [Product::class, 'getCategory']);