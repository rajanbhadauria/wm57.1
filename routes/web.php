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
    return view('index');
});

Route::get('/know-more', function () {
    return view('knowmore');
});

Auth::routes();

Route::get('/activate/{user_id}/{token}', array('as' => 'activate', 'uses' => 'UserController@activate'));
Route::get('/activate-account', array('as' => 'activate-account', 'uses' => 'UserController@activateAccountPage'));
Route::get('/resend-activation', array('as' => 'resend-activation', 'uses' => 'UserController@resendActivation'));
Route::get('/logout', 'HomeController@logout')->name('logout');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/testmail', 'Auth\LoginController@sendEmail');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(array('prefix' => 'user'), function(){
	Route::any('/profile-image', array('as' => 'user.upload-file', 'uses' => 'UserController@profileImage'));
	Route::any('/upload-file', array('as' => 'user.upload-file', 'uses' => 'UploadController@uploadFile'));
	Route::any('/save-profile-image', array('as' => 'user.save-profile-image', 'uses' => 'UserController@saveProfileImage'));
	Route::any('/save-crop-image', array('as' => 'user.save-crop-image', 'uses' => 'UserController@saveCropImage'));
    Route::any('/remove-image', array('as' => 'user.remove-image', 'uses' => 'UserController@imageRemove'));

});
