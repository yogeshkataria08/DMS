<?php

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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');
Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index', 'middleware' => ['auth','twofactor']]);

/*
 *  Cancer Type module
 *  get files from resources/views/categories
 * */
Route::group(array('prefix' => 'categories', 'as' => 'categories::','middleware' => ['permission','auth','twofactor']), function() {
    Route::any('/', ['as' => 'indexCategories', 'uses' => 'CategoriesController@index']);
    Route::post('datatable', ['uses' => 'CategoriesController@datatable']);
    Route::get('add', ['as' => 'createCategories', 'uses' => 'CategoriesController@create']);
    Route::get('edit/{id}', ['as' => 'editCategories', 'uses' => 'CategoriesController@edit']);
    Route::post('store', ['as' => 'storeCategories', 'uses' => 'CategoriesController@store']);
    Route::post('update', ['as' => 'updateCategories', 'uses' => 'CategoriesController@update']);
    Route::post('delete', ['as' => 'deleteCategories', 'uses' => 'CategoriesController@delete']);
});

/*
 *  User module
 *  get files from resources/views/user
 * */
Route::group(array('prefix' => 'user', 'as' => 'user::' , 'middleware' => ['auth','twofactor']), function() {
    Route::any('/', ['as' => 'indexUser', 'uses' => 'UserController@index']);
    Route::get('add', ['as' => 'createUser', 'uses' => 'UserController@create']);
    Route::get('edit/{id}', ['as' => 'editUser', 'uses' => 'UserController@edit']);
    Route::post('delete', ['as' => 'deleteUser', 'uses' => 'UserController@delete']);
    Route::post('store', ['as' => 'storeUser', 'uses' => 'UserController@store']);
    Route::post('update', ['as' => 'updateUser', 'uses' => 'UserController@update']);
    Route::post('datatable', ['uses' => 'UserController@datatable']);
    Route::get('/export', 'UserController@exportCsv');
});

/*
 *  Product module
 *  get files from resources/views/product
 * */
Route::group(array('prefix' => 'product', 'as' => 'product::','middleware' => ['permission','auth','twofactor']), function() {
    Route::any('/', ['as' => 'indexProduct', 'uses' => 'ProductController@index']);
    Route::post('datatable', ['uses' => 'ProductController@datatable']);
    Route::get('add', ['as' => 'createProduct', 'uses' => 'ProductController@create']);
    Route::get('edit/{id}', ['as' => 'editProduct', 'uses' => 'ProductController@edit']);
    Route::post('store', ['as' => 'storeProduct', 'uses' => 'ProductController@store']);
    Route::post('update', ['as' => 'updateProduct', 'uses' => 'ProductController@update']);
    Route::post('delete', ['as' => 'deleteProduct', 'uses' => 'ProductController@delete']);
});

Route::get('/download/{id}', ['as' => 'downloadPlan', 'uses' => 'ProductController@download', 'middleware' => ['auth','twofactor']]);
