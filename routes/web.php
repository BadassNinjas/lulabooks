<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/api/products', 'ProductController@getProducts');
Route::get('/api/products/{productId}', 'ProductController@getProduct');
Route::put('/api/products/{productId}', 'ProductController@createOrUpdateProduct');
Route::delete('/api/products/{productId}', 'ProductController@deleteProduct');
Route::post('/api/products', 'ProductController@createOrUpdateProduct');
Route::get('/api/products/search/{search_term}', 'ProductController@searchProducts');

Route::post('/api/products/{productId}/image/', 'ProductController@attachImage');
Route::delete('/api/products/{productId}/image/{imageId}', 'ProductController@addProductImage');

Route::get('/api/basket', 'CartController@getShoppingCart');
Route::post('/api/basket', 'CartController@addToShoppingCart');
Route::delete('/api/basket/{productId}', 'CartController@removeShoppingCartItem');

Route::get('/api/auth', 'AuthController@checkLogin');
Route::post('/api/auth', 'AuthController@doLogin');
Route::post('/api/auth/login', 'AuthController@doLogin');
Route::post('/api/auth/register', 'AuthController@doRegister');
Route::delete('/api/auth', 'AuthController@doLogout');

Route::get('/api/categories/{categoryId?}', 'ProductCategoryController@getCategories');
Route::post('/api/categories', 'ProductCategoryController@createOrUpdateCategory');
Route::post('/api/categories/{categoryId}', 'ProductCategoryController@createOrUpdateCategory');
Route::delete('/api/categories/{categoryId?}', 'ProductCategoryController@deleteCategory');

Route::get('/api/render/products', 'RenderController@getRenderProducts');
Route::get('/api/render/products/{category_id}', 'RenderController@getRenderProductsOnCategory');
Route::get('/api/render/countries', 'RenderController@getWorldCountries');
Route::get('/api/render/regions/{country_id}', 'RenderController@getRegionsOnCountry');
Route::get('/api/render/cities/{region_id}', 'RenderController@getCitiesOnRegion');

Route::get('/api/sales/request', 'SalesRequestController@getSalesRequests');
Route::post('/api/sales/request', 'SalesRequestController@submitSalesRequest');
Route::put('/api/sales/request/{requestId}', 'SalesRequestController@submitSalesRequest');
Route::delete('/api/sales/request/{requestId}', 'SalesRequestController@deleteSalesRequest');

Route::get('/api/orders', 'OrdersController@getOrders');
Route::put('/api/orders/{orderid}', 'OrdersController@submitOrder');
Route::delete('/api/orders/{orderid}', 'OrdersController@deleteOrder');

Route::post('/api/contact', 'ContactController@submitContactMessage');

Route::post('/api/checkout/billing', 'CheckoutController@updateBillingDetail');
Route::post('/api/checkout/shipping', 'CheckoutController@updateShippingDetail');

Route::get('/api/payment/methods', 'PaymentController@getPaymentMethods');
Route::get('/api/payment/prepare/{payment_method}', 'PaymentController@getPreparedPayment');
Route::post('/api/payment/notify', 'PaymentController@postPaymentNotification');

 Route::group(['prefix' => '/admin'], function () {
     Route::get('/', 'Base\Controller@renderAdminPage');
     Route::get('{path}', 'Base\Controller@renderAdminPage')->where('path', '.+');
 });

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'Base\Controller@renderCustomerPage');
    Route::get('{path}', 'Base\Controller@renderCustomerPage')->where('path', '.+');
});
