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
Route::group(['namespace' => 'Admin','middleware' => 'admin'], function(){
	Route::get("/admin/dashboard",'AdminController@getDashboard');
	Route::get('/admin/manager-member', 'UserController@getAllUser');
	Route::get('admin/category/{id?}', 'CategoryController@getCategoryId');
	Route::post('admin/category/add', function() {
	    //
	});
	Route::delete('admin/category/delete', 'CategoryController@deleteCategory');
	Route::put('admin/category/edit', 'CategoryController@putEditCategory');
	// Route::get('admin/manager-member', 'MemberController@managerMember');
	Route::get('admin/categories', 'CategoryController@getAllCategory');
	Route::get('admin/folders', 'FolderController@getAllFolders');
	Route::get('admin/packages', 'PackageController@getAllPackage');

	Route::get('admin/users/{id}', 'UserController@getUserId');
	Route::delete('admin/user/delete', 'UserController@deleteUserId');
});
Route::get('login', 'UserController@getLogin');
Route::post('login', 'UserController@postLogin');
Route::get('logout', 'UserController@postLogout');

Route::get('register', 'UserController@getRegister');
Route::post('register', 'UserController@postRegister');
Route::get('timeline', 'UserController@showDocument');
Route::get('edituser', 'UserController@editUser');;
Route::get('purchases', 'UserController@getPurchases');
Route::post('language', 'UserController@postLanguage');

Route::get('/',['as'=>'home', 'uses'=> 'HomeController@index']); //list of folders

Route::get('/{category_code?}', 'CategoryController@getListOfCategories'); //list of categories

Route::get('/folder/{translate_name_text?}', 'FolderController@getListOfPackages'); //list of packages

Route::get('/package/{text_value?}', 'PackageController@getListOfChapters'); //list of chapters

Route::get('/{category_code}/{translate_name_text_folder}/{translate_name_text_package}/{translate_name_text_chapter?}', 'ChapterController@getchapter');

Route::get('/{category_code}/{translate_name_text_folder}/{translate_name_text_package}/{translate_name_text_chapter/{translate_name_text_chapter}}', 'ChapterController@getchapter');


//-------------------------------------------------------------


//-------------------------------------------------------------------------------------
Route::group(['middleware' => 'users'], function() {

    Route::get('edituser', 'UserController@editUser');
    Route::put('edituser', 'UserController@putEditUser');
    Route::get('/timeline', 'UserController@showDocument');
    Route::get('/categories/{id?}', 'CategoryController@getCategory');
    Route::get('/folder/{id?}', 'FolderController@getFolder');
    Route::get('logout', 'UserController@postLogout');
    Route::get('create', 'CategoryController@createQuestion');

    Route::post('addfolder', 'FolderController@postAddFolder');
    Route::post('addpackage', 'PackageController@postAddPackage');
    Route::post('addchapter', 'ChapterController@postAddChapter');

    // Route::post('edituser', 'UserController@postEditUser');
});

// Route::get('/',['as'=>'home', 'uses'=> 'HomeController@index']);

// // Route::group(['namespace' => 'Admin'/*,'middleware' => 'admin'*/], function() {

// //     Route::get('admin/dashboard', function() {
// //         return view('admin.dashboard');
// //     });
// //     Route::get('admin/member', 'AdminController@getMember');
// // });

