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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('panel.auth.login');
});
Route::post('/logout', 'LoginController@logout')->name('logout');
Route::get('/admin/login', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware'=>['auth']],function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // --------------- Role routes ---------------------- //
    Route::get('/role/view', 'Admin\RoleController@view')->name('role-view');
    Route::any('/role/create', 'Admin\RoleController@store')->name('role-create');
    Route::any('/role/update/{id}', 'Admin\RoleController@update')->name('role-update');
    Route::post('/role/delete/{id}', 'Admin\RoleController@delete')->name('role-delete');
    Route::get('/role/permissions/{id}', 'Admin\RoleController@permissions_by_role')->name('role-permission');
    // --------------- Permission routes ---------------------- //
    Route::get('/permission/view', 'Admin\PermissionController@view')->name('permission-view');
    Route::any('/permission/create', 'Admin\PermissionController@store')->name('permission-create');
    Route::any('/permission/update/{id}', 'Admin\PermissionController@update')->name('permission-update');
    Route::post('/permission/delete', 'Admin\PermissionController@delete')->name('permission-delete');
    Route::get('/permission/role/{id}', 'Admin\PermissionController@role_by_permission')->name('permission-role');
    // --------------- User routes ---------------------- //
    Route::get('/user/view', 'Admin\UserController@view')->name('user-view');
    Route::post('/user/create', 'Admin\UserController@store')->name('user-create');
    Route::post('/user/update', 'Admin\UserController@update')->name('user-update');
    Route::post('/user/delete', 'Admin\UserController@delete')->name('user-delete');
});

