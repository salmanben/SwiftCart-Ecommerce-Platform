<?php

use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\VendorRequestController;
use App\Http\Controllers\frontend\FrontendVendorController;
use App\Http\Controllers\frontend\CheckOutController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\FrontendProductController;
use App\Http\Controllers\frontend\UserProfileController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\LoginSocialController;
use App\Http\Controllers\frontend\NewsletterController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\ProductFilterController;
use App\Http\Controllers\frontend\ProductPagesController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\frontend\TermsController;
use App\Http\Controllers\frontend\UserAddressController;
use App\Http\Controllers\frontend\UserDashboardController;
use App\Http\Controllers\frontend\VendorShopController;
use App\Http\Controllers\frontend\WishProductController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'verified', 'customer'], 'prefix' => 'user', 'as' => 'user.'], function () {

    /************* Dashboard **************/
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    /************* Profile **************/
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'update_profile'])->name('update_profile');
    Route::put('profile/update_password', [UserProfileController::class, 'update_password'])->name('update_password');

    /************* User Addresses **************/
    Route::resource('address', UserAddressController::class);

    /************* Checkout **************/
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('checkout/stock_shipping_info', [CheckOutController::class, 'stock_shipping_info'])->name('checkout.stock_shipping_info');

    /************* Payment **************/
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');

    /* PayPal */
    Route::get('payment/paypal', [PaymentController::class, 'payer_paypal'])->name('payment.paypal');
    Route::get('paypal/success', [PaymentController::class, 'success_paypal'])->name('paypal.success');

    /* Stripe */
    Route::post('payment/stripe', [PaymentController::class, 'payer_stripe'])->name('payment.stripe');

    /************* Order **************/
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');

    /************* Wish Product **************/
    Route::get('wish_product', [WishProductController::class, 'index'])->name('wish_product.index');
    Route::post('wish_product', [WishProductController::class, 'store'])->name('wish_product.store');
    Route::delete('wish_product/remove', [WishProductController::class, 'remove'])->name('wish_product.remove');
    Route::delete('wish_product/destroy', [WishProductController::class, 'destroy'])->name('wish_product.destroy');

    /************* Review **************/
    Route::get('review', [ReviewController::class, 'index'])->name('review.index');
    Route::post('review', [ReviewController::class, 'store'])->name('review.store');
    Route::delete('review/{id}', [ReviewController::class, 'delete'])->name('review.delete');

    /************* Vendor Request **************/
    Route::get('vendor_request', [VendorRequestController::class, 'create'])->name('vendor_request.create');
    Route::post('vendor_request', [VendorRequestController::class, 'store'])->name('vendor_request.store');

    /*********** Cart View ***************/
    Route::get('cart_view', [CartController::class, 'cart_view'])->name('cart_view');
    Route::post('coupon_apply', [CartController::class, 'apply_coupon'])->name('coupon_apply');
});

/*********** Login ***************/
Route::get('/admin/login', fn () => view('admin.auth.login'))->name('admin.login')->middleware('guest');
Route::get('/auth/redirect_github', [LoginSocialController::class, 'redirect_github'])->name('github.auth.redirect');
Route::get('/auth/callback', [LoginSocialController::class, 'login_github'])->name('github.auth.callback');
Route::get('/auth/redirec_google', [LoginSocialController::class, 'redirect_google'])->name('google.auth.redirect');
Route::get('/auth_google/auth/callback', [LoginSocialController::class, 'login_google'])->name('google.auth.callback');
/*********** Flash Sale ***************/
Route::get('/flash_sale', [ProductPagesController::class, 'get_flash_sale_items'])->name('flash_sale');
Route::get('/popular_products', [ProductPagesController::class, 'get_popular_products'])->name('popular_products');
require __DIR__ . '/auth.php';


/*********** Product Details ***************/
Route::get('product_details/{id}', [FrontendProductController::class, 'show'])->name('product_details');
Route::post('product_details_price', [FrontendProductController::class, 'get_price'])->name('product_details_price');


/*********** Cart ***************/
Route::post('cart_add', [CartController::class, 'add_to_cart'])->name('cart_add');
Route::delete('cart_destroy', [CartController::class, 'cart_destroy'])->name('cart_destroy');
Route::delete('cart_remove', [CartController::class, 'cart_remove'])->name('cart_remove');
Route::put('cart_update/{rowId}', [CartController::class, 'cart_update'])->name('cart_update');

/** Product Filter **/
Route::get('product', [ProductFilterController::class, 'index'])->name('product.filter');

/** Subscribe Newsletter **/
Route::post('newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter');
Route::get('newsletter/verify_email/{token}', [NewsletterController::class, 'verify_email'])->name('newsletter.verify_email');

/** Vendors Page **/
Route::get('vendor', [FrontendVendorController::class, 'index'])->name('frontend_vendor.index');

/** store Page **/
Route::get('store', [VendorShopController::class, 'index'])->name('store.index');

/** About page **/
Route::get('about', [AboutController::class, 'index'])->name('about.index');

/** Terms And Conditions page **/
Route::get('terms_conditions', [TermsController::class, 'index'])->name('terms.index');

/** Contact page **/
Route::get('contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
