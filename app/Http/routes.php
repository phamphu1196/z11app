<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('test','TestController@test');
Route::get('/upload', function() {
	return view('test');
});
Route::post('upload',['as' => 'upload', 'uses' => 'TestController@test']);

Route::group(['namespace' => 'Admin','middleware' => 'admin'], function(){
	Route::get("/admin/dashboard",'AdminController@getDashboard');
	Route::get('admin/category/{id?}', 'CategoryController@getCategoryId');
	Route::post('admin/category/add', function() {
	    //
	});
	Route::delete('admin/category/delete', function() {
	    //
	});
	Route::put('admin/category/edit', function() {
	    //
	});
	Route::get('admin/manager-member', 'MemberController@managerMember');
	Route::get('admin/categories', 'CategoryController@getAllCategory');
	Route::get('admin/folders', 'FolderController@getAllFolders');
	Route::get('admin/packages', 'PackageController@getAllPackage');
});
Route::get('login', 'UserController@getLogin');
Route::post('login', 'UserController@postLogin');
Route::get('logout', 'UserController@postLogout');

Route::get('register', 'UserController@getRegister');
Route::post('register', 'UserController@postRegister');
Route::get('/timeline', 'UserController@showDocument');
Route::get('edituser', 'UserController@editUser');;
Route::get('purchases', 'UserController@getPurchases');

Route::get('/',['as'=>'home', 'uses'=> 'HomeController@index']);

Route::get('/{category_code?}', 'CategoryController@getCategory');

Route::get('/{category_code}/{translate_name_text?}', 'FolderController@getFolder');

Route::get('/{category_code}/{translate_name_text}/{translate_name_text_package?}', 'PackageController@getPackage');
Route::get('/{category_code}/{translate_name_text_folder}/{translate_name_text_package}/{translate_name_text_chapter?}', 'ChapterController@getchapter');



Route::post('language', 'UserController@postLanguage');

//-------------------------------------------------------------


//-------------------------------------------------------------------------------------
// Route::group(['middleware' => 'users'], function() {

//     Route::get('edituser', 'UserController@editUser');
//     Route::post('edituser', 'UserController@postEditUser');

//     Route::get('/timeline', 'UserController@showDocument');
//     Route::get('/categories/{id?}', 'CategoryController@getCategory');
//     Route::get('/folder/{id?}', 'FolderController@getFolder');
//     Route::get('logout', 'UserController@postLogout');
//     Route::get('create', 'CategoryController@createQuestion');

//     Route::post('addfolder', 'FolderControlle@postAddFolder');

//     // Route::post('edituser', 'UserController@postEditUser');
// });

// Route::get('/',['as'=>'home', 'uses'=> 'HomeController@index']);

// // Route::group(['namespace' => 'Admin'/*,'middleware' => 'admin'*/], function() {

// //     Route::get('admin/dashboard', function() {
// //         return view('admin.dashboard');
// //     });
// //     Route::get('admin/member', 'AdminController@getMember');
// // });

