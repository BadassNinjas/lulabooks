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
Route::put('/api/products/{productId}', 'ProductController@createOrUpdateProduct');
Route::delete('/api/products/{productId}', 'ProductController@deleteProduct');
Route::post('/api/products', 'ProductController@createOrUpdateProduct');

Route::post('/api/products/{productId}/image/', 'ProductController@addProductImage');
Route::delete('/api/products/{productId}/image/{imageId}', 'ProductController@addProductImage');

Route::get('/api/basket', 'CartController@getShoppingCart');
Route::post('/api/basket', 'CartController@addToShoppingCart');

Route::get('/api/auth', 'AuthController@checkLogin');
Route::post('/api/auth', 'AuthController@doLogin');
Route::delete('/api/auth', 'AuthController@doLogout');

Route::get('/api/categories/{categoryId?}', 'ProductCategoryController@getCategories');
Route::post('/api/categories', 'ProductCategoryController@createOrUpdateCategory');
Route::post('/api/categories/{categoryId}', 'ProductCategoryController@createOrUpdateCategory');
Route::delete('/api/categories/{categoryId?}', 'ProductCategoryController@deleteCategory');


 Route::group(['prefix' => '/admin'], function () {
     Route::get('/', 'Base\Controller@renderAdminPage');
     Route::get('{path}', 'Base\Controller@renderAdminPage')->where('path', '.+');
 });

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'Base\Controller@renderCustomerPage');
    Route::get('{path}', 'Base\Controller@renderCustomerPage')->where('path', '.+');
});
