<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//register
Route::post('/register', 'Api\AuthController@register');
//login
Route::post('/login', 'Api\AuthController@login');
//logout
Route::get('/logout', 'Api\AuthController@logout');

Route::group([
    'middleware' => 'auth:api'
], function () {
    //get list lession
    Route::get('/lessons/{page?}/{size?}', 'Api\LessonController@getlesson');
    //download
    Route::get('download-zip/{lessonId?}','Api\LessonController@downloadZip');
    //get schools
    Route::get('/schools/{page?}/{size?}/{district_id?}', 'Api\SchoolController@getschool');
    //get list grades
    Route::get('/grades/{page?}/{size?}', 'Api\GradeController@getgrade');
    //get list thematic
    Route::get('/thematic/{page?}/{size?}', 'Api\ThematicController@getThematic');
    //get classes
    Route::get('/class/{page?}/{size?}/{grade_id?}', 'Api\ClassController@getclass');
});
 //get areas
Route::get('/areas/{page?}/{size?}', 'Api\AreaController@getarea');
//get provinces
Route::get('/provinces/{page?}/{size?}/{area_id?}', 'Api\ProvinceController@getprovince');
//get districts
Route::get('/districts/{page?}/{size?}/{province_id?}', 'Api\DistrictController@getdistrict');
