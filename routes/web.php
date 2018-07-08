<?php

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
Route::get('admin', [
    'as' => 'admin',
    'uses' => 'Admin\AdminController@getIndex'
]);

Route::resource('admin/tieuchuan', 'Admin\TieuChuanController');

Route::resource('admin/tieuchi', 'Admin\TieuChiController');

Route::resource('minhchung', 'Customer\MinhChungController');

Route::get('download-minhchung', [
    'as' => 'download-minhchung',
    'uses' => 'Customer\MinhChungController@exportMinhChung'
]);

Route::resource('vanban', 'Customer\VanBanController');

Route::resource('tieuchuan-user', 'Customer\TieuChuanUserController');

Route::resource('tieuchi-user', 'Customer\TieuChiUserController');

Route::get('vanban/download/{fileName}', [
    'as' => 'download',
    'uses' => 'Customer\VanBanController@getDownload'
]);

Route::get('ajax-tieuchi', [
    'as' => 'ajax-tieuchi',
    'uses' => 'AjaxController@getTieuChi'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/profile/create', [
    'as' => 'profile',
    'uses' => 'UserController@getProfile'
]);

Route::post('admin/profile', [
    'as' => 'profile.store',
    'uses' => 'UserController@postProfile'
]);

Route::get('admin/user', [
    'as' => 'user.index',
    'uses' => 'UserController@getIndex'
]);

Route::delete('admin/delete/{user}', [
    'as' => 'user.delete',
    'uses' => 'UserController@getDelete'
]);

Route::get('admin/user/{user}', [
    'as' => 'user.show',
    'uses' => 'UserController@getShow'
]);

Route::get('download-tieuchuan/{id}', [
    'as' => 'download-tieuchuan',
    'uses' => 'Admin\AdminController@downloadTieuChuan'
]);

Route::get('admin/quyen/{user}', [
    'as' => 'user-role',
    'uses' => 'UserController@getRole'
]);

Route::post('admin/quyen/{user}', [
    'as' => 'user-role',
    'uses' => 'UserController@postRole'
]);

Route::get('get-data', [
    'as' => 'get-data',
    'uses' => 'AjaxController@getDataTieuChi'
]);