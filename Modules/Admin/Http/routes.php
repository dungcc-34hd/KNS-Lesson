<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

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

    // Area
        Route::group(['prefix' => 'area'], function () {
        Route::get('/index', 'AreaController@index')->name('admin.area.index');
        Route::get('/create', 'AreaController@create')->name('admin.area.create');
        Route::post('/store', 'AreaController@store')->name('admin.area.store');
        Route::get('/show/{id}', 'AreaController@show')->name('admin.area.show');
        Route::get('/edit/{id}', 'AreaController@edit')->name('admin.area.edit');
        Route::post('/update/{id}', 'AreaController@update')->name('admin.area.update');
        Route::get('/delete/{id}', 'AreaController@delete')->name('admin.area.delete');
        Route::get('/pagination/{records}/{search?}', 'AreaController@pagination')->name('admin.area.pagination');
    });

    // Provincial
    Route::group(['prefix' => 'province'], function () {
        Route::get('/index', 'ProvinceController@index')->name('admin.province.index');
        Route::get('/create', 'ProvinceController@create')->name('admin.province.create');
        Route::post('/store', 'ProvinceController@store')->name('admin.province.store');
        Route::get('/show/{id}', 'ProvinceController@show')->name('admin.province.show');
        Route::get('/edit/{id}', 'ProvinceController@edit')->name('admin.province.edit');
        Route::post('/update/{id}', 'ProvinceController@update')->name('admin.province.update');
        Route::get('/delete/{id}', 'ProvinceController@delete')->name('admin.province.delete');
        Route::get('/pagination/{records}/{search?}', 'ProvinceController@pagination')->name('admin.province.pagination');
    });

    // District
    Route::group(['prefix' => 'district'], function () {
        Route::get('/index', 'DistrictController@index')->name('admin.district.index');
        Route::get('/create', 'DistrictController@create')->name('admin.district.create');
        Route::post('/store', 'DistrictController@store')->name('admin.district.store');
        Route::get('/show/{id}', 'DistrictController@show')->name('admin.district.show');
        Route::get('/edit/{id}', 'DistrictController@edit')->name('admin.district.edit');
        Route::post('/update/{id}', 'DistrictController@update')->name('admin.district.update');
        Route::get('/delete/{id}', 'DistrictController@delete')->name('admin.district.delete');
        Route::get('/pagination/{records}/{search?}', 'DistrictController@pagination')->name('admin.district.pagination');
    });

    // School
    Route::group(['prefix' => 'school'], function () {
        Route::get('/index', 'SchoolController@index')->name('admin.school.index');
        Route::get('/create', 'SchoolController@create')->name('admin.school.create');
        Route::post('/store', 'SchoolController@store')->name('admin.school.store');
        Route::get('/show/{id}', 'SchoolController@show')->name('admin.school.show');
        Route::get('/edit/{id}', 'SchoolController@edit')->name('admin.school.edit');
        Route::post('/update/{id}', 'SchoolController@update')->name('admin.school.update');
        Route::get('/delete/{id}', 'SchoolController@delete')->name('admin.school.delete');
        Route::get('/pagination/{records}/{search?}', 'SchoolController@pagination')->name('admin.school.pagination');
        Route::get('/treeView','SchoolController@treeView')->name('admin.school.treeView');

    });

    // Class
    Route::group(['prefix' => 'class'], function () {
        Route::get('/index', 'ClassController@index')->name('admin.class.index');
        Route::get('/create', 'ClassController@create')->name('admin.class.create');
        Route::post('/store', 'ClassController@store')->name('admin.class.store');
        Route::get('/show/{id}', 'ClassController@show')->name('admin.class.show');
        Route::get('/edit/{id}', 'ClassController@edit')->name('admin.class.edit');
        Route::post('/update/{id}', 'ClassController@update')->name('admin.class.update');
        Route::get('/delete/{id}', 'ClassController@delete')->name('admin.class.delete');
        Route::get('/pagination/{records}/{search?}', 'ClassController@pagination')->name('admin.class.pagination');
    });

    // Lesson
    Route::group(['prefix' => 'lesson'], function () {
        Route::get('/index', 'LessonController@index')->name('admin.lesson.index');
        Route::get('/create', 'LessonController@create')->name('admin.lesson.create');
        Route::post('/store', 'LessonController@store')->name('admin.lesson.store');
        Route::get('/show/{id}', 'LessonController@show')->name('admin.lesson.show');
        Route::get('/edit/{id}', 'LessonController@edit')->name('admin.lesson.edit');
        Route::post('/update/{id}', 'LessonController@update')->name('admin.lesson.update');
        Route::get('/delete/{id}', 'LessonController@delete')->name('admin.lesson.delete');
        Route::get('/pagination/{records}/{search?}', 'LessonController@pagination')->name('admin.lesson.pagination');
    });

    // title lesson
    Route::group(['prefix' => 'title-lesson'], function () {
        Route::get('/index', 'TitleLessonController@index')->name('admin.titleLesson.index');
        Route::get('/create', 'TitleLessonController@create')->name('admin.titleLesson.create');
        Route::post('/store-grade', 'TitleLessonController@storeGrade')->name('admin.titleLesson.storeGrade');
        Route::post('/store-lesson-detail', 'TitleLessonController@storeLessonDetail')->name('admin.titleLesson.storeLessonDetail');
        Route::post('/store-lesson-content', 'TitleLessonController@storeLessonContent')->name('admin.titleLesson.storeLessonContent');
        Route::get('/show/{id}', 'TitleLessonController@show')->name('admin.titleLesson.show');
        Route::get('/edit/{id}', 'TitleLessonController@edit')->name('admin.titleLesson.edit');
        Route::post('/update/{id}', 'TitleLessonController@update')->name('admin.titleLesson.update');
        Route::get('/delete/{id}', 'TitleLessonController@delete')->name('admin.titleLesson.delete');
        Route::get('/pagination/{records}/{search?}', 'TitleLessonController@pagination')->name('admin.titleLesson.pagination');
    });
});
//Login
Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function () {

    //Login
    Route::group(['prefix' => 'login'], function () {
        Route::get('/', 'LoginController@index')->name('admin.login.index');
        Route::post('/', 'LoginController@login')->name('admin.login.process');
    });

    //Logout
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');
});