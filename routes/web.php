<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;


//Route for Front
Route::get('/',[\App\Http\Controllers\FrontController::class,'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[\App\Http\Controllers\ShopController::class,'index'])->name('front.shop');
Route::get('/product/{productSlug?}',[\App\Http\Controllers\ShopController::class,'product'])->name('front.product');


// Route for front page

Route::get('/page/{slug}',[\App\Http\Controllers\FrontController::class,'page'])->name('front.page');

use App\Http\Controllers\CartController;

// Route to display the cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');

// Route to add a product to the cart
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

// Route to update the quantity of a product in the cart
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

// Route to remove a product from the cart
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/get-order-summery', [CartController::class, 'getOrderSummery'])->name('front.getOrderSummery');

//applyDiscount
Route::post('/apply-Discount', [CartController::class, 'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount', [CartController::class, 'removeCoupon'])->name('front.removeDiscount');

//apply ratting
Route::post('/save-rating/{productId}',[\App\Http\Controllers\ShopController::class, 'saveRating'])->name('front.saveRating');
Route::get('/product/{id}/ratings', [\App\Http\Controllers\ShopController::class, 'getProductRatings'])->name('front.getRatings');


// Routes for user account
Route::prefix('account')->group(function () {
    // Guest routes (accessible only when not authenticated)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('account.login');
        Route::post('/authenticate', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [\App\Http\Controllers\LoginController::class, 'register'])->name('account.register');
        Route::post('/process-register', [\App\Http\Controllers\LoginController::class, 'processRegister'])->name('account.processRegister');
    });

    // Authenticated routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('account.logout');

        Route::get('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('front.checkout');
        Route::post('/process-Checkout', [\App\Http\Controllers\CartController::class, 'processCheckout'])->name('front.processCheckout');
       Route::get('/thanks/{id}', [\App\Http\Controllers\CartController::class, 'thankyou'])->name('front.thankyou');


        Route::get('/profile', [\App\Http\Controllers\LoginController::class, 'account'])->name('front.account');
        Route::post('update/profile', [\App\Http\Controllers\LoginController::class, 'updateProfile'])->name('front.UpdateAccount');
        Route::get('password', [\App\Http\Controllers\LoginController::class, 'password'])->name('front.Password');
        Route::post('change-password', [\App\Http\Controllers\LoginController::class, 'changePassword'])->name('front.updatePassword');

        Route::get('/order', [\App\Http\Controllers\LoginController::class, 'orders'])->name('front.order');
        Route::get('/order-detail/{orderId}', [\App\Http\Controllers\LoginController::class, 'orderDetail'])->name('account.orderDetail');

        Route::post('/add-to-wishlist/{id}', [\App\Http\Controllers\FrontController::class, 'addToWishlist'])->name('front.addToWishlist');

        // Route for displaying the user's wishlist
        Route::get('/wishlist', [\App\Http\Controllers\FrontController::class, 'wishlist'])
            ->name('wishlist.index');

        // Route for removing a product from the wishlist
        Route::post('/remove-from-wishlist', [\App\Http\Controllers\FrontController::class, 'removeProductFromWishList'])
            ->name('wishlist.remove');

        // Route for Rating
//        Route::post('/save-rating/{productId}', [\App\Http\Controllers\ShopController::class, 'saveRating'])->name('front.saveRating');

        // Route for displaying a product with ratings
        Route::get('/product/{id}', [\App\Http\Controllers\ShopController::class, 'showProduct'])->name('front.showProduct');


    });
});

// Routes for admin
Route::prefix('admin')->group(function () {
    // Admin guest routes (accessible only when not authenticated as admin)
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\admin\LoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [\App\Http\Controllers\admin\LoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    // Admin authenticated routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [\App\Http\Controllers\admin\LoginController::class, 'logout'])->name('admin.logout');

        // Category Routes
        Route::get('/categories', [\App\Http\Controllers\admin\CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [\App\Http\Controllers\admin\CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [\App\Http\Controllers\admin\CategoryController::class, 'store'])->name('categories.store');
         Route::get('/categories/{category}/edit', [\App\Http\Controllers\admin\CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [\App\Http\Controllers\admin\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [\App\Http\Controllers\admin\CategoryController::class, 'destroy'])->name('categories.destroy');

        //temp-images.create
        Route::post('/admin/temp-images', [\App\Http\Controllers\admin\TempImageController::class, 'store'])->name('temp-images.store');
        Route::delete('/admin/temp-images', [\App\Http\Controllers\admin\TempImageController::class, 'delete'])->name('temp-images.delete');


        //Sub-category Route
        Route::get('/sub_categories', [\App\Http\Controllers\admin\SubCategoryController::class, 'index'])->name('sub_categories.index');
        Route::get('/sub_categories/create', [\App\Http\Controllers\admin\SubCategoryController::class, 'create'])->name('sub_categories.create');
        Route::post('/sub_categories', [\App\Http\Controllers\admin\SubCategoryController::class, 'store'])->name('sub_categories.store');
        Route::get('/sub_categories/{sub_category}/edit', [\App\Http\Controllers\admin\SubCategoryController::class, 'edit'])->name('sub_categories.edit');
        Route::put('/sub_categories/{sub_category}', [\App\Http\Controllers\admin\SubCategoryController::class, 'update'])->name('sub_categories.update');
        Route::delete('/sub_categories/{sub_category}', [\App\Http\Controllers\admin\SubCategoryController::class, 'destroy'])->name('sub_categories.destroy');

        Route::resource('subcategories', \App\Http\Controllers\admin\SubCategoryController::class);

        // Brands Route
        Route::get('/brands', [\App\Http\Controllers\admin\BrandsControlller::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [\App\Http\Controllers\admin\BrandsControlller::class, 'create'])->name('brands.create');
        Route::post('/brands', [\App\Http\Controllers\admin\BrandsControlller::class, 'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit', [\App\Http\Controllers\admin\BrandsControlller::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [\App\Http\Controllers\admin\BrandsControlller::class, 'update'])->name('brands.update');
        Route::delete('/brands/{brand}', [\App\Http\Controllers\admin\BrandsControlller::class, 'destroy'])->name('brands.destroy');

        // Products Route
        Route::get('/products', [\App\Http\Controllers\admin\ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [\App\Http\Controllers\admin\ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [\App\Http\Controllers\admin\ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [\App\Http\Controllers\admin\ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [\App\Http\Controllers\admin\ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [\App\Http\Controllers\admin\ProductController::class, 'destroy'])->name('products.destroy');



        Route::get('/products-subcategories', [\App\Http\Controllers\admin\ProductSubCategoryController::class, 'index'])->name('product.subcategories.index');

        Route::get('products-images',[\App\Http\Controllers\admin\ProductImageController::class,'store'])->name('product-images.store');
        Route::delete('product-image', [\App\Http\Controllers\admin\ProductImageController::class, 'delete'])->name('product-images.delete');



        // Orders Route
        Route::get('/orders', [\App\Http\Controllers\admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [\App\Http\Controllers\admin\OrderController::class, 'detail'])->name('orders.detail');
        Route::post('/orders/change-status/{id}', [\App\Http\Controllers\admin\OrderController::class, 'changeOrderStatus'])->name('orders.changeOrderStatus');


        // Pages Route
        Route::get('/pages', [\App\Http\Controllers\admin\PageController::class, 'index'])->name('page.index');
        Route::get('/pages/create', [\App\Http\Controllers\admin\PageController::class, 'create'])->name('page.create');
        Route::post('/pages', [\App\Http\Controllers\admin\PageController::class, 'store'])->name('page.store');
        Route::get('/pages/{page}/edit', [\App\Http\Controllers\admin\PageController::class, 'edit'])->name('page.edit');
        Route::put('/pages/{page}', [\App\Http\Controllers\admin\PageController::class, 'update'])->name('page.update');
        Route::delete('/pages/{page}', [\App\Http\Controllers\admin\PageController::class, 'destroy'])->name('page.destroy');

        //Route User
        Route::get('/users', [\App\Http\Controllers\admin\UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [\App\Http\Controllers\admin\UserController::class, 'create'])->name('users.create');
        Route::post('/users', [\App\Http\Controllers\admin\UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [\App\Http\Controllers\admin\UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [\App\Http\Controllers\admin\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [\App\Http\Controllers\admin\UserController::class, 'destroy'])->name('users.destroy');


        // Shipping Routes
        Route::get('/shipping', [\App\Http\Controllers\admin\ShippingController::class, 'index'])->name('shipping.index');
        Route::get('/shipping/create', [\App\Http\Controllers\admin\ShippingController::class, 'create'])->name('shipping.create');
        Route::post('/shipping', [\App\Http\Controllers\admin\ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/shipping/{id}/edit', [\App\Http\Controllers\admin\ShippingController::class, 'edit'])->name('shipping.edit');
        Route::put('/shipping/{id}', [\App\Http\Controllers\admin\ShippingController::class, 'update'])->name('shipping.update');
        Route::delete('/shipping/{id}', [\App\Http\Controllers\admin\ShippingController::class, 'destroy'])->name('shipping.destroy');

        //Coupon Code Route
        Route::get('/coupons', [\App\Http\Controllers\admin\DiscountCodeController::class, 'index'])->name('coupons.index');
        Route::get('/coupons/create', [\App\Http\Controllers\admin\DiscountCodeController::class, 'create'])->name('coupons.create');
        Route::post('/coupons', [\App\Http\Controllers\admin\DiscountCodeController::class, 'store'])->name('coupons.store');
        Route::get('/coupons/{id}/edit', [\App\Http\Controllers\admin\DiscountCodeController::class, 'edit'])->name('coupons.edit');
        Route::put('/coupons/{id}', [\App\Http\Controllers\admin\DiscountCodeController::class, 'update'])->name('coupons.update');
        Route::delete('/coupons/{id}', [\App\Http\Controllers\admin\DiscountCodeController::class, 'destroy'])->name('coupons.destroy');

    });
});


