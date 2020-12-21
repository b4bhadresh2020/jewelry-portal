<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



// locale route
Auth::routes();
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('admin');
Route::get('/admin/403', 'Admin\AccessController@forbiddenPage');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    // dashboard
    Route::get('/', 'PageController@blankPage');
    Route::get('/dashboard', 'PageController@blankPage');


    // account
    Route::resource('/account', 'Admin\UserController');
    Route::get('/account/status/{id}/{status}', 'Admin\UserController@updateChange');
    Route::match(['get', 'post'], 'profile', 'Admin\UserController@profile');
    Route::post('change-password', 'Admin\UserController@changePassword');

    // other resource
    Route::resource('/testimonial', 'Admin\TestimonialController');

    // category
    Route::resource('/category', 'Admin\CategoryController');
    Route::get('/category/{id}/change-status/{status}', 'Admin\CategoryController@changeStatus');

    //Sub Category
    Route::resource('/sub-category', 'Admin\SubCategoryController');
    Route::get('/sub-category/{id}/change-status/{status}', 'Admin\SubCategoryController@changeStatus');

    Route::resource('/attribute', 'Admin\AttributeController');
    Route::post('reorder-attribute', 'Admin\AttributeController@reorderAttribute');
    Route::resource('/option', 'Admin\OptionController');
    Route::resource('/permission', 'Admin\PermissionController');
    Route::resource('/user-menu', 'Admin\UserMenuController');
    Route::post('/user-menu/update-menu-order', 'Admin\UserMenuController@updateManuOrder');

    // Attribute Assign
    Route::get('/assign-attr', 'Admin\AttributeAssignController@index');
    Route::post('/assign-attr/assign-attribute', 'Admin\AttributeAssignController@assignAttribute');
    Route::get('/assign-attr/category/{id}', 'Admin\AttributeAssignController@findSubCategoryByCategory');
    Route::get('/assign-attr/sub-category/attribute/{id}', 'Admin\AttributeAssignController@getAttributeBySubcategory');

    //setting list
    Route::resource('language', 'Admin\LanguageController');

    //email_templates
    Route::resource('email', 'Admin\EmailTemplateController');
    Route::post('email-templates-details', 'Admin\EmailTemplateController@emailDetails');

    //product
    Route::resource('product', 'Admin\ProductController');
    Route::get('product\attributeByID', 'Admin\ProductController@getAttributeByID');
    Route::get('product\subCategoryByID', 'Admin\ProductController@getAttributeByID');
    Route::get('product/{id}/change-status/{status}', 'Admin\ProductController@changeStatus');
    Route::get('product/product-detail/{id}', 'Admin\ProductController@findProductDetail');

    // Product
    Route::group(['prefix' => 'product'], function () {
        // Route::middleware("auth", "hierarchical_permissions:edit-sub-category")->prefix("product")->group(function () {
        Route::resource('/', 'Admin\ProductController');

        /* ajax */
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/category/{id}/sub-category', 'Admin\ProductController@findSubCategoryByCategory');
            Route::post('/product-details', 'Admin\ProductController@ajexSaveProductDetails');
            Route::post('/product-variation', 'Admin\ProductController@ajexSaveProductVariation');
        });

        Route::post('finish', 'Admin\ProductController@finish');
        Route::get('attribute/{id}/status/{status}', 'Admin\ProductController@changeStatus');
    });

    //Coupon
    Route::resource('/discount', 'Admin\DiscountController');
    Route::get('/discount/get-sub-category-by-category-id/{id}', 'Admin\DiscountController@findSubCategoryByCategoryId');
    Route::get('/discount/{id}/change-status/{status}', 'Admin\DiscountController@changeStatus');

    //inquiry-information
    Route::resource('inquiry-contact', 'Admin\InquiryController');
    Route::get('inquiry-product', 'Admin\InquiryController@viewInquiryProduct');
    //faq-category
    Route::resource('/faq-category', 'Admin\FaqCategoryController');
    Route::resource('/faq', 'Admin\FaqController');

    //other
    Route::get('activity-log', 'Admin\ActivityLogController@index');
    //cutomer
    Route::resource('customer', 'Admin\CustomerController');
    Route::get('/customer/status/{id}/{status}/', 'Admin\CustomerController@updateChange');

    //service
    Route::resource('service', 'Admin\ServiceController');

    //banner
    Route::resource('banner', 'Admin\BannerController');
    Route::post('reorder-banner', 'Admin\BannerController@reorderBanner');

    //offer
    Route::resource('offer', 'Admin\OfferController');
    Route::post('offer-status-update', 'Admin\OfferController@changeOfferStatus');

    //blog
    Route::resource('blog', 'Admin\BlogController');

    //subscriber
    Route::get('subscriber-list', 'Admin\SubScriberController@index');
    Route::delete('subscribe-delete/{id}', 'Admin\SubScriberController@destroy');

    //collection
    Route::resource('collection', 'Admin\CollectionController');

    //custom-category
    Route::resource('/custom-category', 'Admin\CustomCategoryController');
    Route::get('/custom-category/{id}/change-status/{status}', 'Admin\CustomCategoryController@changeStatus');

    //custom-sub-category
    Route::resource('/custom-sub-category', 'Admin\CustomSubCategoryController');
    Route::get('/custom-sub-category/{id}/change-status/{status}', 'Admin\CustomSubCategoryController@changeStatus');

    //paymentgateway
    Route::resource('/payment-gateway', 'Admin\PaymentGatewayController');
    Route::post('payment-gateway-status-update', 'Admin\PaymentGatewayController@changePaymentGatewayStatus');
    //seller
    Route::resource('/seller', 'Admin\SellerController');
    Route::get('/seller/{id}/change-status/{status}', 'Admin\SellerController@changeStatus');

    Route::get('setting', 'Admin\AppSettingController@index');
    Route::post('setting/general', 'Admin\AppSettingController@__general');
    Route::post('setting/social-link', 'Admin\AppSettingController@__socialLink');
    Route::post('setting/home-page', 'Admin\AppSettingController@__homePage');
});

/*******************************
        Frontend routes
 *******************************/

// Home Page Routes
Route::get('/', 'Customer\HomeController@index');
Route::get('/home', 'Customer\HomeController@index');
Route::get('/home/{type}/banner', 'Customer\HomeController@homeBanners');
Route::get('/single-blog-view/{id}', 'Customer\HomeController@singleBlogView');
Route::post('/subscribe', 'Customer\HomeController@Subscriber');
Route::get('/blog', 'Customer\HomeController@blog');
Route::get('/contact', 'Customer\HomeController@contact');
Route::post('/contact-store', 'Customer\HomeController@contactStore');
Route::get('/faq', 'Customer\HomeController@faq');

// Customer Signin & Signout
Route::get('/signin', 'Customer\AuthController@signInForm')->name('customer.login');
Route::post('/signin', 'Customer\AuthController@signIn');
Route::get('/signup', 'Customer\AuthController@signUpForm');

Route::post('/signup', 'Customer\AuthController@signUp');
Route::post('/ajex/signup', 'Customer\AuthController@ajexSignUp');

Route::get('/signout', 'Customer\AuthController@signOut');

// Customer Forget Password
Route::get('/reset-password', 'Customer\AuthController@resetPassword');
Route::get('/password/reset/{token}/{code}', 'Customer\AuthController@showResetForm');
Route::get('/reset', 'Customer\AuthController@forgetPassword');
Route::post('/reset-password-link', 'Customer\AuthController@resetPasswordLinkSend');
Route::post('/otp-verify', 'Customer\AuthController@otpVerify');
Route::post('/password/reset', 'Customer\AuthController@reset_pass')->name('password.update');

// Customer Social Signin & Signup
Route::get('auth/{provider}', 'Customer\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Customer\AuthController@handleProviderCallback');

// Customer Dashboard
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', 'Customer\DashboardController@index')->name('customer.dashboard');
    Route::match(['get', 'post'], '/profile', 'Customer\DashboardController@profile');

    // Change Password
    Route::get('/change-password', 'Customer\DashboardController@changePassword');
    Route::post('/change-password', 'Customer\DashboardController@postChangePassword');
    Route::get('/orders', 'Customer\DashboardController@orders');

    // Other Resources
    Route::resource('/address', 'Customer\AddressController');
});

// Common Usefull Route [Ajax]
Route::post('states-by-country', 'CommonAjaxController@getState');
Route::post('cities-by-state', 'CommonAjaxController@getCity');

// Product
Route::get('product/{slug}/{sku?}', 'Customer\ProductController@singleProductView');
Route::get('product-variation', 'Customer\ProductController@ajaxProductVariation');

/* Product filters */
Route::get('products', 'Customer\ProductController@products');
Route::get('products/{mainCategorySlug}', 'Customer\ProductController@productsByCategory');
Route::get('products/{mainCategorySlug}/{subCategorySlug}', 'Customer\ProductController@productsBySubCategory');
Route::get('products-filter/{page}', 'Customer\ProductController@ajaxProductsFilter');
Route::get('/subcategory-by-product/{id}', 'Customer\ProductController@subCategoryByProduct');

// Testing routes & Other routes
Route::get('test', "TestingController@index");

//Cart
Route::get('/cart', 'Customer\CartController@cart');
Route::get('/add-to-cart', 'Customer\CartController@addToCart');
Route::get('/remove-cart/{id}', 'Customer\CartController@removeCart');
Route::get('/update-qty-to-cart', 'Customer\CartController@updateQtyCart');
Route::get('/all-cart-remove', 'Customer\CartController@allCartRemove');
Route::get('/clear-cart', 'Customer\CartController@clear');


//review-rating
Route::post('/store-rating', 'Customer\ProductController@reviewStore');
Route::get('/add-grand-amount', 'Customer\CartController@addGrandAmount');

//Order
Route::get('/checkout', 'Customer\OrderController@checkout');
Route::post('/apply-coupon-code', 'Customer\OrderController@applyCouponCode');
