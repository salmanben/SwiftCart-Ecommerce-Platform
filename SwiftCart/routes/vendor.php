<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\VendorController;
use App\Http\Controllers\backend\VendorDashboardController;
use App\Http\Controllers\backend\VendorOrderController;
use App\Http\Controllers\backend\VendorShopProfileController;
use App\Http\Controllers\backend\VendorProductController;
use App\Http\Controllers\backend\VendorProductVariantController;
use App\Http\Controllers\backend\VendorProductVariantItemController;
use App\Http\Controllers\backend\VendorProductImageGalleryController;
use App\Http\Controllers\backend\VendorReviewController;
use App\Http\Controllers\backend\VendorWithdrawRequestController;

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

/****** Dashboard ******/
Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard_get_chart', [VendorDashboardController::class, 'get_chart'])->name('dashboard.get_chart');
/****** Profile ******/
Route::get('profile', [VendorController::class, 'index'])->name('profile');
Route::put('profile', [VendorController::class, 'update_profile'])->name('update_profile');
Route::put('profile/update_password', [VendorController::class, 'update_password'])->name('update_password');

/***** Shop *******/
Route::resource('shop_profile', VendorShopProfileController::class);

/****** Product **/
Route::put('product/switch_status', [VendorProductController::class, 'switch_status'])->name('product.switch_status');
Route::get('product/sub_category', [VendorProductController::class, 'get_sub_categories'])
->name('product.sub_category');
Route::get('product/child_category', [VendorProductController::class, 'get_child_categories'])
->name('product.child_category');
Route::resource('product', VendorProductController::class);


/****** Product  Image Gallery ********/
Route::resource('product_image_gallery', VendorProductImageGalleryController::class);

/****** Product Variant ********/
Route::put('product_variant/switch_status', [VendorProductVariantController::class, 'switch_status'])->name('product_variant.switch_status');
Route::resource('product_variant', VendorProductVariantController::class);


/****** Product Variant Item********/
Route::put('product_variant_item/switch_status', [VendorProductVariantItemController::class, 'switch_status'])->name('product_variant_item.switch_status');
Route::resource('product_variant_item', VendorProductVariantItemController::class);

/****** Order********/
Route::get('order', [VendorOrderController::class, 'index'])->name('order.index');
Route::get('order/{id}', [VendorOrderController::class, 'show'])->name('order.show');
Route::put('order/switch_status', [VendorOrderController::class, 'switch_status'])->name('order.switch_status');

/****** Review **********/
Route::get('review', [VendorReviewController::class, 'index'])->name('review.index');

/****** Withdraw **********/
Route::resource('withdraw', VendorWithdrawRequestController::class);

