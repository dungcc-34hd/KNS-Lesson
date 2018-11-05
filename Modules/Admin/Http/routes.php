<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminController@index')->name('admin.index');

    //Login
    Route::group(['prefix' => 'login'], function () {
        Route::get('/', 'LoginController@index')->name('admin.login.index');
        Route::post('/', 'LoginController@login')->name('admin.login.process');
    });

    //Logout
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');

    //Role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->name('admin.role.index');
        Route::get('/pagination/{records}/{search?}', 'RoleController@pagination')->name('admin.role.pagination');
        Route::get('/view/{id}', 'RoleController@view')->name('admin.role.view');
        Route::get('/edit/{id}', 'RoleController@edit')->name('admin.role.edit');
        Route::post('/edit/{id}', 'RoleController@edit')->name('admin.role.edit');
        Route::get('/create', 'RoleController@create')->name('admin.role.create');
        Route::post('/create', 'RoleController@create')->name('admin.role.create');
        Route::get('/delete/{id}', 'RoleController@delete')->name('admin.role.delete');
        Route::get('/delete-view-detail/{id}', 'RoleController@deleteViewDetail')->name('admin.role.deleteViewDetail');
    }); 
    
    //Permission
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', 'PermissionController@index')->name('admin.permission.index');
        Route::get('/pagination/{records}/{search?}', 'PermissionController@pagination')->name('admin.permission.pagination');
        Route::get('/show/{id}', 'PermissionController@show')->name('admin.permission.show');
        Route::get('/edit/{id}', 'PermissionController@edit')->name('admin.permission.edit');
        Route::post('/edit/{id}', 'PermissionController@update')->name('admin.permission.update');
        Route::get('/create', 'PermissionController@create')->name('admin.permission.create');
        Route::post('/store', 'PermissionController@store')->name('admin.permission.store');
        Route::get('/delete/{id}', 'PermissionController@destroy')->name('admin.permission.delete');
    });
    
    //User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.index');
        Route::get('/pagination/{records}/{search?}', 'UserController@pagination')->name('admin.user.pagination');
        Route::get('/show/{id}', 'UserController@show')->name('admin.user.show');
        Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
        Route::post('/edit/{id}', 'UserController@update')->name('admin.user.update');
        Route::get('/create', 'UserController@create')->name('admin.user.create');
        Route::post('/store', 'UserController@store')->name('admin.user.store');
        Route::get('/delete/{id}', 'UserController@destroy')->name('admin.user.delete');
        Route::get('/get-roles/{id}', 'UserController@getRolesByUserID')->name('admin.user.get-roles');
    });
});
