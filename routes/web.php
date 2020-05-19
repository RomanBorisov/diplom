<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('/profile', 'ProfileController@profile');
Route::post('/profileupdate', 'ProfileController@update');

Route::get('/changepassword', 'ProfileController@changePasswordView');
Route::post('/changepassword', 'ProfileController@changePassword');

Route::get('/nexmo', 'NexmoController@show')->name('nexmo');
Route::post('/nexmo', 'NexmoController@verify')->name('nexmo');

Route::get('/verifydoc', 'NexmoController@getDocVerify')->name('getverifydoc');
Route::post('/verifydoc', 'NexmoController@postDocVerify')->name('verify');

Route::get('/dashboard', 'DashboardController@index');

Route::resource('documents', 'DocumentsController');
Route::put('documents/{id}/verifydoc', 'DocumentsController@verificate');


