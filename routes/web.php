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
Route::get('/login',"Auth\LoginController@showLoginPage");

/*Register a new user*/
Route::post('/register-new-user',"Auth\RegisterController@register");

/*Activate new user*/
Route::get('/walulel/account/activation/{value}',"ActivateAccountController@activateAccount");
Route::get('/verify',"ActivateAccountController@showVerifyPage");

/*Login a logout a  user */
Route::post('/login',"Auth\LoginController@login")->name('login');
Route::get('logout',"Auth\LoginController@logout");


/*authenticated user views*/
Route::get('/preview',"UserController@showPreviewPage");
Route::get('/community',"UserController@showCommunityPage");
Route::get('/single-post/{post}/{title}',"UserController@showSinglePost");
Route::get('/community/{category}/{category_name}',"UserController@sortByCategory");

/*authenticatrred user forum functionality */
Route::post('/create-post',"UserController@createPost");
Route::post('/create-reply/{post}/{title}',"UserController@createReply");
Route::post('/search-results',"UserController@searchTopics");

/*post reactions */
Route::post('/likepost',"UserController@likePost");
Route::post('/dislikepost',"UserController@dislikePost");