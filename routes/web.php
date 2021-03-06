<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\checklogin;
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


//frontend
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');
Route::post('/tim-kiem', 'HomeController@search');

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}', 'BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@details_product');


// Category Product

Route::get('/add-category-product', 'CategoryProduct@add_category_product');

Route::get('/all-category-product', 'CategoryProduct@all_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');

Route::post('/save-category-product', 'CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');





// Cart
Route::post('/save-cart', 'CartController@save_cart');
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');

// Checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::post('/order-place', 'CheckoutController@order_place');
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::get('/checkout', 'CheckoutController@checkout');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');


// Admin
Route::get('/admin', 'AdminController@index');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::middleware([checklogin::class])->group(function () {
    Route::get('/dashboard', 'AdminController@show_dashboard');

    Route::get('/logout', 'AdminController@logout');
    // Order
    Route::get('/manager-order', 'CheckoutController@manager_order');
    Route::get('/view-order/{orderId}', 'CheckoutController@view_order');
    Route::get('/delete-order/{orderId}', 'CheckoutController@delete_order');

    // Category Product

    Route::get('/all-category-product', 'CategoryProduct@all_category_product');

    Route::get('/add-category-product', 'CategoryProduct@add_category_product');
    Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
    Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');

    Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
    Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');

    Route::post('/save-category-product', 'CategoryProduct@save_category_product');
    Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');

    // Brand

    Route::get('/add-brand-product', 'BrandProduct@add_brand_product');

    Route::get('/all-brand-product', 'BrandProduct@all_brand_product');
    Route::get('/edit-brand-product/{brand_product_id}', 'BrandProduct@edit_brand_product');
    Route::get('/delete-brand-product/{brand_product_id}', 'BrandProduct@delete_brand_product');

    Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProduct@unactive_brand_product');
    Route::get('/active-brand-product/{brand_product_id}', 'BrandProduct@active_brand_product');

    Route::post('/save-brand-product', 'BrandProduct@save_brand_product');
    Route::post('/update-brand-product/{brand_product_id}', 'BrandProduct@update_brand_product');

    // Product

    Route::get('/add-product', 'ProductController@add_product');

    Route::get('/all-product', 'ProductController@all_product');
    Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
    Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

    Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
    Route::get('/active-product/{product_id}', 'ProductController@active_product');

    Route::post('/save-product', 'ProductController@save_product');
    Route::post('/update-product/{product_id}', 'ProductController@update_product');
    // User
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index'
        ]);
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create'
        ]);
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'users.destroy',
            'uses' => 'AdminUserController@destroy'
        ]);
    });
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRoleController@index'
        ]);
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRoleController@create'
        ]);
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRoleController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'AdminRoleController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' =>'roles.destroy',
            'uses' => 'AdminRoleController@destroy'
        ]);
    });
});
