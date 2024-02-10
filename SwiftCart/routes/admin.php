<?php

use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminDashboardController;
use App\Http\Controllers\backend\AdminVendorProfileController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\ChildCategoryController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\FlashSaleController;
use App\Http\Controllers\backend\HomeSettingController;
use App\Http\Controllers\backend\Newsletter;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PaymentSettingController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\ProductImageGalleryController;
use App\Http\Controllers\backend\ProductVariantController;
use App\Http\Controllers\backend\ProductVariantItemController;
use App\Http\Controllers\backend\ReviewController;
use App\Http\Controllers\backend\SellerProductsController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\ShippingRuleController;
use App\Http\Controllers\backend\TransactionController;
use App\Http\Controllers\backend\TermsController;
use App\Http\Controllers\backend\UsersListController;
use App\Http\Controllers\backend\VendorRequestController;
use App\Http\Controllers\backend\WithdrawMethodController;
use App\Http\Controllers\backend\WithdrawRequestController;
use Illuminate\Support\Facades\Route;

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

/****** Dashboard ********/
Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard_get_chart', [AdminDashboardController::class, 'get_chart'])->name('dashboard.get_chart');

/****** Profile ********/
Route::get('profile', [AdminController::class, 'index'])->name('profile');
Route::post('profile/update', [AdminController::class, 'update_profile'])->name('profile.update');
Route::post('profile/password/update', [AdminController::class, 'update_password'])->name('password.update');

/****** Slider ********/
Route::put('slider/switch_status', [SliderController::class, 'switch_status'])->name('slider.switch_status');
Route::resource('slider', SliderController::class);

/****** Category ********/
Route::put('category/switch_status', [CategoryController::class, 'switch_status'])->name('category.switch_status');
Route::resource('category', CategoryController::class);

/****** Sub Category ********/
Route::put('sub_category/switch_status', [SubCategoryController::class, 'switch_status'])->name('sub_category.switch_status');
Route::resource('sub_category', SubCategoryController::class);

/****** Child Category ********/
Route::post('child_category/sub_category', [ChildCategoryController::class, 'get_sub_categories'])
->name('child_category.sub_category');
Route::put('child_category/switch_status', [ChildCategoryController::class, 'switch_status'])->name('child_category.switch_status');
Route::resource('child_category', ChildCategoryController::class);


/****** Brand ********/
Route::put('brand/switch_status', [BrandController::class, 'switch_status'])->name('brand.switch_status');
Route::resource('brand', BrandController::class);

/****** Admin Vendor ********/
Route::resource('vendor_profile', AdminVendorProfileController::class);

/****** Product ********/
Route::put('product/switch_status', [ProductController::class, 'switch_status'])->name('product.switch_status');
Route::get('product/sub_category', [ProductController::class, 'get_sub_categories'])
->name('product.sub_category');
Route::get('product/child_category', [ProductController::class, 'get_child_categories'])
->name('product.child_category');
Route::resource('product', ProductController::class);

/****** Product  Image Gallery ********/
Route::resource('product_image_gallery', ProductImageGalleryController::class);

/****** Product Variant ********/
Route::put('product_variant/switch_status', [ProductVariantController::class, 'switch_status'])->name('product_variant.switch_status');
Route::resource('product_variant', ProductVariantController::class);


/****** Product Variant Item ********/
Route::put('product_variant_item/switch_status', [ProductVariantItemController::class, 'switch_status'])->name('product_variant_item.switch_status');
Route::resource('product_variant_item', ProductVariantItemController::class);


/****** Seller Products ********/
Route::get('seller_products', [SellerProductsController::class, 'get_seller_products'])->name('seller_products');
Route::get('seller_pending_products', [SellerProductsController::class, 'get_seller_products'])->name('seller_pending_products');
Route::put('seller_products/switch_status', [SellerProductsController::class, 'switch_status'])->name('seller_products.switch_status');
Route::put('seller_products/switch_approve', [SellerProductsController::class, 'switch_approve'])->name('seller_products.switch_approve');
/****** Flash Sale ********/
Route::put('flash_sale/switch_show_at_home_status', [FlashSaleController::class, 'switch_show_at_home_status'])->name('flash_sale.switch_show_at_home_status');
Route::put('flash_sale/switch_status', [FlashSaleController::class, 'switch_status'])->name('flash_sale.switch_status');
Route::put('flash_sale/save_end_date', [FlashSaleController::class, 'save_end_date'])->name('flash_sale.save_end_date');
Route::resource('flash_sale', FlashSaleController::class);

/****** Coupon System ********/
Route::put('coupon/switch_status', [CouponController::class, 'switch_status'])->name('coupon.switch_status');
Route::resource('coupon', CouponController::class);


/****** Setting **********/
Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
Route::PUT('general_setting', [SettingController::class, 'update_general_setting'])->name('general_setting.update');
Route::PUT('email_setting', [SettingController::class, 'update_email_setting'])->name('email_setting.update');

/****** Shipping Rule **********/
Route::PUT('shipping_rule/switch_status', [ShippingRuleController::class, 'switch_status'])->name('shipping_rule.switch_status');
Route::resource('shipping_rule', ShippingRuleController::class);

/****** Payment Setting **********/
Route::get('payment_setting', [PaymentSettingController::class, 'index'])->name('payment_setting');
Route::put('paypal_setting', [PaymentSettingController::class, 'update_paypal_setting'])->name('paypal_setting');
Route::put('stripe_setting', [PaymentSettingController::class, 'update_stripe_setting'])->name('stripe_setting');

/****** Order **********/
Route::put('order/switch_status', [OrderController::class, 'switch_status'])->name('order.switch_status');
Route::get('order/pending', [OrderController::class, 'show_orders_by_status'])->name('order.pending');
Route::get('order/processed', [OrderController::class, 'show_orders_by_status'])->name('order.processed');
Route::get('order/dropped_off', [OrderController::class, 'show_orders_by_status'])->name('order.dropped_off');
Route::get('order/shipped', [OrderController::class, 'show_orders_by_status'])->name('order.shipped');
Route::get('order/out_for_delivery', [OrderController::class, 'show_orders_by_status'])->name('order.out_for_delivery');
Route::get('order/delivered', [OrderController::class, 'show_orders_by_status'])->name('order.delivered');
Route::get('order/canceled', [OrderController::class, 'show_orders_by_status'])->name('order.canceled');
Route::resource('order',OrderController::class);
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::delete('transaction/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');

/****** Home Setting **********/
Route::get('home_setting', [HomeSettingController::class, 'index'])->name('home_setting.index');
Route::put('home_setting/update_top_categories', [HomeSettingController::class, 'update_top_categories'])->name('home_setting.update_top_categories');
Route::put('home_setting/update_single_categories', [HomeSettingController::class, 'update_single_categories'])->name('home_setting.update_single_categories');
Route::put('home_setting/update_footer_info', [HomeSettingController::class, 'update_footer_info'])->name('home_setting.update_footer_info');
Route::put('home_setting/update_box_background', [HomeSettingController::class, 'update_box_background'])->name('home_setting.update_box_background');

/****** Newsletter**********/
Route::get('newsletter_subscribers', [Newsletter::class, 'index'])->name('newsletter_subscribers.index');
Route::delete('newsletter_subscribers/{id}', [Newsletter::class, 'delete'])->name('newsletter_subscribers.delete');
Route::post('newsletter_subscribers', [Newsletter::class, 'send_email'])->name('newsletter_subscribers.send_email');

/****** Banner **********/
Route::get('banner', [BannerController::class, 'index'])->name('banner.index');
Route::put('banner/update_home_banner_section_one', [BannerController::class, 'update_home_banner_section_one'])->name('banner.update_home_banner_section_one');
Route::put('banner/update_home_banner_section_two', [BannerController::class, 'update_home_banner_section_two'])->name('banner.update_home_banner_section_two');
Route::put('banner/update_home_banner_section_three', [BannerController::class, 'update_home_banner_section_three'])->name('banner.update_home_banner_section_three');
Route::put('banner/update_home_banner_section_four', [BannerController::class, 'update_home_banner_section_four'])->name('banner.update_home_banner_section_four');
Route::put('banner/update_home_banner_section_five', [BannerController::class, 'update_home_banner_section_five'])->name('banner.update_home_banner_section_five');
Route::put('banner/update_product_filter_banner', [BannerController::class, 'update_product_filter_banner'])->name('banner.update_product_filter_banner');
Route::put('banner/update_cart_view_banner', [BannerController::class, 'update_cart_view_banner'])->name('banner.update_cart_view_banner');

/****** Review System **********/
Route::get('review', [ReviewController::class, 'index'])->name('review.index');
Route::delete('review/{id}', [ReviewController::class, 'delete'])->name('review.delete');

/****** About Page **********/
Route::get('about', [AboutController::class, 'index'])->name('about.index');
Route::put('about', [AboutController::class, 'update'])->name('about.update');

/****** Terms **********/
Route::get('terms', [TermsController::class, 'index'])->name('terms.index');
Route::put('terms', [TermsController::class, 'update'])->name('terms.update');

/****** Users **********/
Route::get('user/customer', [UsersListController::class, 'index_customer'])->name('index_customer');
Route::get('user/vendor', [UsersListController::class, 'index_vendor'])->name('index_vendor');
Route::get('user/admin', [UsersListController::class, 'index_admin'])->name('index_admin');
Route::put('user/switch_status', [UsersListController::class, 'switch_status'])->name('user.switch_status');
Route::delete('user/admin_destroy/{id}', [UsersListController::class, 'admin_destroy'])->name('user_admin.destroy');

/****** Vendor Request **********/
Route::resource('vendor_request', VendorRequestController::class);

/****** Contact Messages From Users **********/
Route::get('contact',[ContactController::class, 'index'])->name('contact.index');
Route::delete('contact/{id}',[ContactController::class, 'destroy'])->name('contact.destroy');


/****** WithDraw **********/
Route::PUT('withdraw_method/switch_status', [WithdrawMethodController::class, 'switch_status'])->name('withdraw_method.switch_status');
Route::resource('withdraw_method', WithdrawMethodController::class);
Route::get('withdraw_request', [WithdrawRequestController::class, 'index'])->name('withdraw_request.index');
Route::get('withdraw_request/{id}', [WithdrawRequestController::class, 'show'])->name('withdraw_request.show');
Route::PUT('withdraw_request/switch_status', [WithdrawRequestController::class, 'switch_status'])->name('withdraw_request.switch_status');
