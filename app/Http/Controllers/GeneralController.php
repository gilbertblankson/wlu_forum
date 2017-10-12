<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class GeneralController extends Controller
{
    /*This controller contains functions to handle 
    general navigations which do not
    require signup/login*/
   
    public function showHomePage(){
        return view('index');
    }

    public function showAboutPage(){
        return view('about');
    }

    public function showTeamPage(){
        return view('team');
    }

    public function showContactPage(){
        return view('contact');
    }

    public function showSurveyPage(){
        return view('survey');
    }

    public function showSignupPage(){
        return view('sign-up');
    }

    public function showLoginPage(){
        return view('login');
    }
}
