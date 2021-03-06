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

Auth::routes();
Route::get('/register/completed', function(){
	if (Auth::user()->activated) {
		return redirect()->route('account.profile');
	}
	return view('auth.registercompleted');
})->name('auth.registercompleted');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/resources', 'ResourceController@resourcesIndex')->name('resources.index');
Route::get('/resources/upload', 'ResourceController@uploadResource')->name('resources.upload');
Route::get('/resources/{id}', 'ResourceController@viewResource')->name('resources.view');
Route::post('/resources/social/function/upvote', 'ResourceController@upvote')->name('resource.social.upvote');
Route::post('/resources/social/function/toplevelcomment', 'ResourceController@topLevelComment')->name('resources.social.toplevelcomment');

Route::post('/moderation/function/submitcontentreport', 'ContentController@submitContentReport')->name('moderation.submitcontentreport');


Route::get('/account', 'AccountController@userProfile')->name('account.profile');
Route::post('/account/changeemail', 'AccountController@changeEmail')->name('account.changeemail');
Route::view('/account/data/download', 'accounts.data.download')->name('account.datadownload');
Route::post('/account/data/download', 'AccountController@processDataDownload')->name('account.datadownload.request');

Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/users', 'AdminController@users')->name('admin.users');
Route::get('/admin/users/groups', 'AdminController@userGroups')->name('admin.users.groups');
Route::get('/admin/users/groups/{id}', 'AdminController@viewUserGroup')->name('admin.users.groups.view');
Route::get('/admin/users/{id}', 'AdminController@viewUser')->name('admin.users.view');
Route::post('/admin/users/{id}', 'AdminController@editUser')->name('admin.users.edit');
Route::get('/admin/registrations', 'AdminController@registrations')->name('admin.registrations');
Route::get('/admin/registrations/{id}', 'AdminController@viewPendingRegistration')->name('admin.registrations.view');
Route::get('/admin/registrations/{id}/activate', 'AdminController@activateUser')->name('admin.registrations.activateuser');


Route::get('/test', function(){
    return \App\User::all()->toJson(JSON_PRETTY_PRINT);
});