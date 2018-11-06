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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'web', 'namespace' => '\Common'], function() {
//pagination
    Route::get('/pagination/{current_page}/{total_page}', 'PaginationController@index');
});
Route::prefix('admin/areas')->group(function () {
    Route::get('index', 'AreaController@index')->name('areas/index');
    Route::get('create', 'AreaController@create')->name('areas/create');
    Route::post('store', 'AreaController@store')->name('areas/store');
    Route::get('view?id', 'AreaController@view')->name('areas/view');
    Route::get('edit?id', 'AreaController@edit')->name('areas/edit');
    Route::post('update?id', 'AreaController@update')->name('areas/update');
    Route::delete('delete?id', 'AreaController@delete')->name('areas/delete');
});