<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    //Role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->name('admin.role.index');
        Route::get('/pagination/{records}/{search?}', 'RoleController@pagination')->name('admin.role.pagination');
        Route::get('/view/{id}', 'RoleController@view')->name('admin.role.view');
        Route::get('/edit/{id}', 'RoleController@edit')->name('admin.role.edit');
        Route::post('/edit/{id}', 'RoleController@update')->name('admin.role.update');
        Route::get('/create', 'RoleController@create')->name('admin.role.create');
        Route::post('/store', 'RoleController@store')->name('admin.role.store');
        Route::get('/delete/{id}', 'RoleController@delete')->name('admin.role.delete');
        Route::get('/checkName/{id?}', 'RoleController@checkName')->name('admin.role.checkName');


    });

    //Permission
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', 'PermissionController@index')->name('admin.permission.index');
        Route::get('/pagination/{records}/{search?}', 'PermissionController@pagination')->name('admin.permission.pagination');
        Route::get('/edit/{id}', 'PermissionController@edit')->name('admin.permission.edit');
        Route::post('/edit/{id}', 'PermissionController@update')->name('admin.permission.update');
        Route::get('/create', 'PermissionController@create')->name('admin.permission.create');
        Route::post('/store', 'PermissionController@store')->name('admin.permission.store');
        Route::get('/delete/{id}', 'PermissionController@destroy')->name('admin.permission.delete');
        Route::get('/change-radio/{id}/{value}', 'PermissionController@changeRadio')->name('admin.permission.changeRadio');

    });

    //User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.index');
        Route::get('/pagination/{records}/{search?}', 'UserController@pagination')->name('admin.user.pagination');
        Route::get('/pagination_Select/{records}/{table}/{id}', 'UserController@pagination_Select')->name('admin.user.paginationSelect');
        Route::get('/show/{id}', 'UserController@show')->name('admin.user.show');
        Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
        Route::post('/edit/{id}', 'UserController@update')->name('admin.user.update');
        Route::post('/edit-Password/{id}', 'UserController@updatePassword')->name('admin.user.updatePassword');
        Route::get('/create', 'UserController@create')->name('admin.user.create');
        Route::post('/store', 'UserController@store')->name('admin.user.store');
        Route::get('/delete/{id}', 'UserController@destroy')->name('admin.user.delete');
        Route::get('change-select/{areaId}','UserController@changeSelect')->name('admin.user.change-select');
        Route::get('change-province/{provinceId}','UserController@changeProvince')->name('admin.user.change-province');
        Route::get('change-district/{districtId}','UserController@changeDistrict')->name('admin.user.change-district');
        Route::get('change-grade/{gradeId}','UserController@changeGrade')->name('admin.user.change-grade');
        Route::get('/select','UserController@select')->name('admin.user.select');


        // ajax
        Route::get('/hanlding-area','UserController@hanldingArea')->name('admin.statistic.hanldingArea');
        Route::get('/hanlding-province','UserController@hanldingProvince')->name('admin.statistic.hanldingProvince');
        Route::get('/hanlding-district','UserController@hanldingDistrict')->name('admin.statistic.hanldingDistrict');
        Route::get('/hanlding-school','UserController@hanldingSchool')->name('admin.statistic.hanldingSchool');
        Route::get('/checkEmail/{id?}','UserController@checkEmail')->name('admin.user.checkEmail');

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
        Route::get('change-area/{areaId}', 'DistrictController@changeArea')->name('admin.district.changeArea');
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
        Route::get('/pagination_Select/{records}/{table}/{id}', 'SchoolController@pagination_Select')->name('admin.school.paginationSelect');
        Route::get('/treeView','SchoolController@treeView')->name('admin.school.treeView');
        Route::get('change-area/{areaId}','SchoolController@changeArea')->name('admin.school.change-area');
        Route::get('change-province/{provinceId}','SchoolController@changeProvince')->name('admin.school.change-province');
        Route::get('change-district/{districtId}','SchoolController@changeDistrict')->name('admin.school.change-district');
// ajax
        Route::get('/hanlding-area','SchoolController@hanldingArea')->name('admin.school.hanldingArea');
        Route::get('/hanlding-province','SchoolController@hanldingProvince')->name('admin.school.hanldingProvince');
        Route::get('/hanlding-district','SchoolController@hanldingDistrict')->name('admin.school.hanldingDistrict');
        Route::get('/select','SchoolController@select')->name('admin.school.select');



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
// grade
    Route::group(['prefix' => 'grade'], function () {
        Route::get('/index', 'GradeController@index')->name('admin.grade.index');
        Route::get('/create', 'GradeController@create')->name('admin.grade.create');
        Route::post('/store', 'GradeController@store')->name('admin.grade.store');
        Route::get('/show/{id}', 'GradeController@show')->name('admin.grade.show');
        Route::get('/edit/{id}', 'GradeController@edit')->name('admin.grade.edit');
        Route::post('/update/{id}', 'GradeController@update')->name('admin.grade.update');
        Route::get('/delete/{id}', 'GradeController@delete')->name('admin.grade.delete');
        Route::get('/pagination/{records}/{search?}', 'GradeController@pagination')->name('admin.grade.pagination');
    });

    // manager lesson
    Route::group(['prefix' => 'manager-lesson'], function () {
        Route::get('/index', 'ManagerLessonController@index')->name('admin.managerLesson.index');

        Route::get('/add-lesson', 'ManagerLessonController@addLesson')->name('admin.managerLesson.addLesson');
        Route::get('/edit-lesson/{id}', 'ManagerLessonController@editLesson')->name('admin.managerLesson.editLesson');
        Route::get('/check-lesson-name/{id?}', 'ManagerLessonController@checkLessonName')->name('admin.managerLesson.checkLessonName');

        Route::post('/store-lesson', 'ManagerLessonController@storeLesson')->name('admin.managerLesson.storeLesson');
        Route::post('/update-lesson/{id}', 'ManagerLessonController@updateLesson')->name('admin.managerLesson.updateLesson');

        Route::post('/store-lesson-detail', 'ManagerLessonController@storeLessonDetail')->name('admin.managerLesson.storeLessonDetail');
        Route::get('/check-lesson-detail-name/{lessonId}/{detailLesson?}', 'ManagerLessonController@checkLessonDetailName')->name('admin.managerLesson.checkLessonDetailName');
        Route::get('/edit-lesson-detail/{id}', 'ManagerLessonController@editLessonDetail')->name('admin.managerLesson.editLessonDetail');
        Route::post('/update-lesson-detail/{id}', 'ManagerLessonController@updateLessonDetail')->name('admin.managerLesson.updateLessonDetail');

        Route::post('/store-lesson-content', 'ManagerLessonController@storeLessonContent')->name('admin.managerLesson.storeLessonContent');

        Route::get('/get-value-type/{id}', 'ManagerLessonController@getValueType')->name('admin.managerLesson.getValueType');
        Route::get('/get-value-lesson-detail/{id}', 'ManagerLessonController@getValueLessonDetail')->name('admin.managerLesson.getValueLessonDetail');
        Route::get('/show-detail-lesson/{id}', 'ManagerLessonController@showDetailLesson')->name('admin.managerLesson.showDetailLesson');
        Route::get('/edit-lesson-content/{id}', 'ManagerLessonController@editLessonContent')->name('admin.managerLesson.editLessonContent');
        Route::post('/update-lesson-content/{id}', 'ManagerLessonController@updateLessonContent')->name('admin.managerLesson.updateLessonContent');
        Route::get('/edit/{id}', 'ManagerLessonController@edit')->name('admin.managerLesson.edit');
        Route::post('/update/{id}', 'ManagerLessonController@update')->name('admin.managerLesson.update');
        Route::get('/add-lesson-json/{id}', 'ManagerLessonController@jsonLesson')->name('admin.managerLesson.jsonLesson');
        Route::get('/delete/{id}', 'ManagerLessonController@delete')->name('admin.managerLesson.delete');
        Route::get('/delete-lesson/{id}', 'ManagerLessonController@deleteLesson')->name('admin.managerLesson.deleteLesson');
        Route::get('/delete-lesson-detail/{id}', 'ManagerLessonController@deleteLessonDetail')->name('admin.managerLesson.deleteLessonDetail');
        Route::get('/pagination/{records}/{search?}', 'ManagerLessonController@pagination')->name('admin.managerLesson.pagination');
        Route::get('public/{id}','ManagerLessonController@publicObject')->name('admin.managerLesson.public');
        Route::get('test/{id}','ManagerLessonController@testObject')->name('admin.managerLesson.test');
        Route::get('zip/{id}','ManagerLessonController@zip')->name('admin.managerLesson.zip');
    });

    // statistic
    Route::group(['prefix'=>'statistic'],function(){
        Route::get('/','StatisticController@index')->name('admin.statistic.index');
        Route::get('/pagination/{records}/{search?}', 'StatisticController@pagination')->name('admin.statistic.pagination');
        Route::get('/change-area/{areaId}','StatisticController@changeArea')->name('admin.statistic.changeArea');
        Route::get('/change-province/{provinceId}','StatisticController@changeProvince')->name('admin.statistic.changeProvince');
        Route::get('/change-district/{districtId}','StatisticController@changeDistrict')->name('admin.statistic.changeDistrict');
        Route::get('/change-school/{schoolId}','StatisticController@changeSchool')->name('admin.statistic.changeSchool');
        Route::get('/change-select/{areaId}/{provinceId}','StatisticController@changeSelect')->name('admin.statistic.changeSelect');


        // ajax
        Route::get('/hanlding-area','StatisticController@hanldingArea')->name('admin.statistic.hanldingArea');
        Route::get('/hanlding-province','StatisticController@hanldingProvince')->name('admin.statistic.hanldingProvince');
        Route::get('/hanlding-district','StatisticController@hanldingDistrict')->name('admin.statistic.hanldingDistrict');
        Route::get('/hanlding-school','StatisticController@hanldingSchool')->name('admin.statistic.hanldingSchool');

    });
    // type-lesson
     Route::group(['prefix'=>'type-lesson'],function(){
        Route::get('/','LessonTypeController@index')->name('admin.typeLesson.index');
        Route::get('/pagination/{records}/{search?}', 'LessonTypeController@pagination')->name('admin.typeLesson.pagination');
        Route::get('/create','LessonTypeController@create')->name('admin.typeLesson.create');
        Route::post('/store','LessonTypeController@store')->name('admin.typeLesson.store');
        Route::get('/edit/{id}','LessonTypeController@edit')->name('admin.typeLesson.edit');
        Route::post('/update/{id}','LessonTypeController@update')->name('admin.typeLesson.update');
        Route::get('/delete/{id}','LessonTypeController@destroy')->name('admin.typeLesson.delete');
        Route::get('/checkName/{id?}','LessonTypeController@checkName')->name('admin.typeLesson.checkName');
        Route::get('/checkId/{id?}', 'LessonTypeController@checkId')->name('admin.typeLesson.checkId');
    });

    Route::group(['prefix'=>'manager-area'],function(){
        Route::get('/','ManagerAreaController@index')->name('admin.managerArea.index');
        Route::get('/create-area','ManagerAreaController@createArea')->name('admin.managerArea.createArea');
        Route::get('/create-province','ManagerAreaController@createProvince')->name('admin.managerArea.createProvince');
        Route::get('/create-district','ManagerAreaController@createDistrict')->name('admin.managerArea.createDistrict');
        Route::post('/store-area','ManagerAreaController@storeArea')->name('admin.managerArea.storeArea');
        Route::post('/store-province','ManagerAreaController@storeProvince')->name('admin.managerArea.storeProvince');
        Route::post('/store-district','ManagerAreaController@storeDistrict')->name('admin.managerArea.storeDistrict');
        Route::get('/edit-area/{id}','ManagerAreaController@editArea')->name('admin.managerArea.editArea');
        Route::get('/edit-province/{id}','ManagerAreaController@editProvince')->name('admin.managerArea.editProvince');
        Route::get('/edit-district/{id}','ManagerAreaController@editDistrict')->name('admin.managerArea.editDistrict');
        Route::post('/update-area/{id}','ManagerAreaController@updateArea')->name('admin.managerArea.updateArea');
        Route::post('/update-province/{id}','ManagerAreaController@updateProvince')->name('admin.managerArea.updateProvince');
        Route::post('/update-district/{id}','ManagerAreaController@updateDistrict')->name('admin.managerArea.updateDistrict');
        Route::get('/delete-area/{id}','ManagerAreaController@deleteArea')->name('admin.managerArea.deleteArea');
        Route::get('/delete-province/{id}','ManagerAreaController@deleteProvince')->name('admin.managerArea.deleteProvince');
        Route::get('/delete-district/{id}','ManagerAreaController@deleteDistrict')->name('admin.managerArea.deleteDistrict');
    });

    // thematic
    Route::group(['prefix' => 'thematic'], function () {
        Route::get('/', 'ThematicController@index')->name('admin.thematic.index');
        Route::get('/create', 'ThematicController@create')->name('admin.thematic.create');
        Route::post('/store', 'ThematicController@store')->name('admin.thematic.store');
        Route::get('/edit/{id}', 'ThematicController@edit')->name('admin.thematic.edit');
        Route::post('/update/{id}', 'ThematicController@update')->name('admin.thematic.update');
        Route::get('/delete/{id}', 'ThematicController@delete')->name('admin.thematic.delete');
        Route::get('/pagination/{records}/{search?}', 'ThematicController@pagination')->name('admin.thematic.pagination');
        Route::get('/checkName/{id?}','ThematicController@checkName')->name('admin.thematic.checkName');
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