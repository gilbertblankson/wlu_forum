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

Route::get('/',"GeneralController@showHomePage");
Route::get('/index',"GeneralController@showHomePage");
Route::get('/home',"GeneralController@showHomePage");
Route::get('/about',"GeneralController@showAboutPage");
Route::get('/team',"GeneralController@showTeamPage");
Route::get('/contact',"GeneralController@showContactPage");
Route::get('/sign-up',"GeneralController@showSignupPage");
Route::get('login',"GeneralController@showLoginPage");
