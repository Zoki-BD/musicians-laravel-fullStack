<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MusicianController;
use Inertia\Inertia;

Route::get('/', function () {
   return view('welcome');
});

Auth::routes();



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes for login
Route::get('/', 'App\Http\Controllers\AuthController@login');
Route::post('post-login', 'App\Http\Controllers\AuthController@postLogin')->name('postLogin');

//Routes for reset the password
Route::get('password-reset', 'App\Http\Controllers\AuthController@passwordReset');
Route::post('password-reset-post', 'App\Http\Controllers\AuthController@passwordResetPost');
Route::get('password-new/{hash}', 'App\Http\Controllers\AuthController@passwordNew');
Route::post('insert-new-password', 'App\Http\Controllers\AuthController@insertNewPassword');





//Routes that need authorization - authentication
Route::middleware('auth')->group(function () {

   //proben za inertiaJS
   Route::get('musiciansInertia', ('App\Http\Controllers\MusicianController@indexInertia'));


   Route::get('logout', 'App\Http\Controllers\AuthController@logout');
   Route::get('main', 'App\Http\Controllers\MainController@index');

   //Routes for MUSICIANS
   Route::get('musicians', ('App\Http\Controllers\MusicianController@index'));
   //Show selected musician in modal by clicking the "eye"button
   Route::get('musicians/show/{id}', ('App\Http\Controllers\MusicianController@show'));

   //get and post the newly created musician
   Route::get('musicians/create', 'App\Http\Controllers\MusicianController@create');
   Route::put('musicians/store', 'App\Http\Controllers\MusicianController@store');

   //get and post the musician we selected and changed some properties in it
   Route::get('musicians/edit/{id}', 'App\Http\Controllers\MusicianController@edit');
   Route::put('musicians/update/{id}', 'App\Http\Controllers\MusicianController@update');

   //deleting the selected musician
   Route::delete('musicians/delete/{id}', 'App\Http\Controllers\MusicianController@destroy');


   //Routes for BANDS
   Route::get('bands', 'App\Http\Controllers\BandController@index');
   //Show selected band in modal by clicking the "eye"button
   Route::get('bands/show/{id}', 'App\Http\Controllers\BandController@show');

   //get and post the newly created band
   Route::get('bands/create', 'App\Http\Controllers\BandController@create');
   Route::put('bands/store', 'App\Http\Controllers\BandController@store');

   //get and post the band we selected and changed some properties in it
   Route::get('bands/edit/{id}', 'App\Http\Controllers\BandController@edit');
   Route::put('bands/update/{id}', 'App\Http\Controllers\BandController@update');

   //deleting the selected musician
   Route::delete('bands/delete/{id}', 'App\Http\Controllers\BandController@destroy');


   //Routes for USERS
   Route::get('users', 'App\Http\Controllers\UsersController@index');
   Route::delete('users/delete/{id}', 'App\Http\Controllers\UsersController@destroy');
   //get and post new User
   Route::get('users/create', 'App\Http\Controllers\UsersController@create');
   Route::put('users/store', 'App\Http\Controllers\UsersController@store');
   //get and post updated User
   Route::get('users/edit/{id}', 'App\Http\Controllers\UsersController@edit');
   Route::put('users/update/{id}', 'App\Http\Controllers\UsersController@update');
});
