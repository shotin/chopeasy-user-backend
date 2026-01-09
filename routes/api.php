<?php

use App\Http\Controllers\v1\Admin\BlogController;
use App\Http\Controllers\v1\Auth\AuthController;
use App\Http\Controllers\v1\Auth\ForgotPasswordController;
use App\Http\Controllers\v1\Auth\ResetPasswordController;
use App\Http\Controllers\v1\Users\AccountController;
use App\Http\Controllers\v1\Users\CartController;
use App\Http\Controllers\v1\Users\OrderController;
use App\Http\Controllers\v1\Users\PaymentController;
use App\Http\Controllers\v1\Users\ProductCategoryController;
use App\Http\Controllers\v1\Users\ProductReviewController;
use App\Http\Controllers\v1\Users\RecentlyViewedController;
use App\Http\Controllers\v1\Users\VendorOrderController;
use App\Http\Controllers\v1\Users\VendorProductController;
use App\Http\Controllers\v1\Users\WishlistController;
use App\Http\Controllers\v1\Users\PostalCodeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLink']);
        Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
        Route::post('/verify/email-otp', [AuthController::class, 'verifyOtp']);
        Route::post('/resend/email-otp', [AuthController::class, 'resendOtp']);
    });

  

    Route::group(["middleware" => ["auth:api"]], function () {
        Route::prefix('account')->group(function () {
            Route::post('/shipping-address', [AccountController::class, 'addShippingAddress']);
            Route::get('/all/shipping-address', [AccountController::class, 'listShippingAddresses']);
            Route::patch('/update/shipping-address/{id}', [AccountController::class, 'updateShippingAddress']);
            Route::delete('/shipping-address/{id}', [AccountController::class, 'deleteShippingAddress']);
            Route::get('/shipping-address/{id}', [AccountController::class, 'getShippingAddress']);
        });

        Route::prefix('auth')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'getUser']);
            Route::get('profile', [AuthController::class, 'profile']);
            Route::put('update', [AuthController::class, 'updateProfile']);
            Route::get('payment/verify/{reference}', [PaymentController::class, 'verify']);
        });
        Route::prefix('vendor')->middleware('auth:api')->group(function () {
            Route::get('subcategories', [VendorProductController::class, 'getSubcategories']);
            Route::post('products-by-category', [VendorProductController::class, 'getProductsByCategory']);
            Route::post('products', [VendorProductController::class, 'storeVendorProducts']);
            Route::post('profile', [VendorProductController::class, 'updateProfile']);
        });
        Route::post('/payment/initialize', [PaymentController::class, 'initialize']);
        Route::get('/payment/callback', [PaymentController::class, 'callback']);
        Route::get('/payment/failed', [PaymentController::class, 'failed']);
        Route::post('/verify-payment', [PaymentController::class, 'verify']);

        Route::prefix('orders')->group(function () {
            Route::post('checkout', [OrderController::class, 'checkout']);
            Route::put('/{order}/update', [OrderController::class, 'update']);
            Route::get('', [OrderController::class, 'getUserOrders']);
            Route::get('/{id}', [OrderController::class, 'getOrderDetails']);
            Route::post('/{id}/reorder', [OrderController::class, 'reorder']);
            Route::get('/completed/all', [VendorOrderController::class, 'vendorOrders']);

            Route::get('/vendor/{orderId}/items', [VendorOrderController::class, 'orderItems']);
            Route::post('/vendor/{vendorOrder}/ready', [VendorOrderController::class, 'toggleItemReady']);
        });

         Route::prefix('rider')->group(function () {
            Route::get('available-pickups', [OrderController::class, 'availablePickups']);
            Route::post('accept-delivery/{orderId}', [OrderController::class, 'acceptDelivery']);
            Route::get('my-pickups', [OrderController::class, 'myPickups']);
        });
    });

    Route::middleware(['auth:api', 'role:Admin,Super Admin'])->group(function () {
        Route::post('/blog', [BlogController::class, 'store']);
        Route::put('/blog/{id}', [BlogController::class, 'update']);
        Route::delete('/blog/{id}', [BlogController::class, 'destroy']);
        Route::get('/admin/orders', [OrderController::class, 'getAllOrdersForAdmin']);
        Route::get('/admin/orders/{orderId}', [OrderController::class, 'getOrderDetailsForAdmin']);
        Route::get('/admin/users', [AuthController::class, 'getAllUsersForAdmin']);
        Route::get('admin/users/{id}', [AuthController::class, 'getSingleUserForAdmin']);
    });

    // Public routes

    // Cart routes (available to both guests and authenticated users)
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::post('/cart/update', [CartController::class, 'updateQuantity']);
    Route::delete('/cart/remove', [CartController::class, 'removeFromCart']);
    Route::post('/cart/add-multiple', [CartController::class, 'addMultipleToCart']);
    Route::delete('/cart/delete-multiple', [CartController::class, 'deleteMultipleFromCart']);
    // routes/api.php
    Route::get('/public/vendor/{vendorId}/products', [VendorProductController::class, 'publicVendorProducts']);
    Route::get('/suggest-address', [PostalCodeController::class, 'suggestAddress']);


    Route::get('/all/vendor', [VendorProductController::class, 'listVendors']);
    Route::get('/all/categories', [VendorProductController::class, 'listVendorCategories']);
    // Store vendor products (bulk add)
    Route::post('/vendor/products', [VendorProductController::class, 'storeVendorProducts']);

    // Show a vendor's product set
    Route::get('/vendor/products/{id}', [VendorProductController::class, 'showVendorProducts']);

    // Update vendor products (replace JSON)
    Route::put('/vendor/products/{id}', [VendorProductController::class, 'updateVendorProducts']);

    // Delete vendor products
    Route::post('/vendor/products/delete', [VendorProductController::class, 'deleteVendorProducts']);

    Route::get('/categories', [ProductCategoryController::class, 'index']);
    Route::post('/products', [ProductCategoryController::class, 'products']);
    Route::get('/all/unit', [ProductCategoryController::class, 'Unitindex']);
    Route::get('/product/{id}', [ProductCategoryController::class, 'getProduct']);
    Route::post('/imagekit', [ProductCategoryController::class, 'uploadImages']);

    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index']);
        Route::post('/', [WishlistController::class, 'store']);
        Route::delete('/{id}', [WishlistController::class, 'destroy']);
    });

    Route::prefix('product')->group(function () {
        Route::post('/rating', [ProductReviewController::class, 'storeRating']);
        Route::post('/review', [ProductReviewController::class, 'storeReview']);
        Route::get('/{productId}/reviews', [ProductReviewController::class, 'showProductReviews']);
    });
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index']);
        Route::get('/{id}', [BlogController::class, 'show']);
    });
});
