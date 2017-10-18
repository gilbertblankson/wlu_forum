<?php


Route::get('/',"GeneralController@showHomePage");
Route::get('/index',"GeneralController@showHomePage");
Route::get('/home',"GeneralController@showHomePage");
Route::get('/about',"GeneralController@showAboutPage")->middleware('checklogged');
Route::get('/team',"GeneralController@showTeamPage")->middleware('checklogged');
Route::get('/contact',"GeneralController@showContactPage")->middleware('checklogged');
Route::get('/sign-up',"GeneralController@showSignupPage");
Route::get('/login',"Auth\LoginController@showLoginPage");

/*no auth log in */
Route::post('/no-auth-login',"GeneralController@niiLogin");
Route::get('/landing-page',"GeneralController@showLandingPage")->middleware('checklogged');

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

/*upload image */
Route::post('/upload-image',"UserController@uploadImage");