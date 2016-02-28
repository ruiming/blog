<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => 'web'], function () {
    Route::get('/','BlogController@main');
    Route::get('/post/{slug}','BlogController@showPost');
    Route::get('/archive','ArchiveController@getArchive');
    Route::get('/archive/{id}','ArchiveController@category');
    Route::get('/date/{year}/{month}','ArchiveController@date');
    Route::auth();
});
Route::group(['middleware'=>['web','auth']],function(){
    Route::get('/admin','HomeController@index');
    Route::Resource('/admin/post', 'PostController');
    Route::Resource('/admin/archive','ArchiveController');
    Route::post('/upload','PostController@upload');
    Route::get('/admin/upload', 'UploadController@index');
    Route::post('admin/upload/file', 'UploadController@uploadFile');
    Route::delete('admin/upload/file', 'UploadController@deleteFile');
    Route::post('admin/upload/folder', 'UploadController@createFolder');
    Route::delete('admin/upload/folder', 'UploadController@deleteFolder');
});

