<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;


class GeneralController extends Controller
{   
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

    public function niiLogin(){
        //this login is merely scripted.
        $this->validate(request(),[
            'username'=>'required|string',
            'password'=>'required',
        ]);

        $username =  request('username');
        $password =  request('password');

        if($username=="niiashie" && $password=="Walulel123*" ){
            $cookie = Cookie::make("logged","logged");
            return redirect('/landing-page')->withCookie($cookie);
        }

        return redirect('/index');
    }

    public function showLandingPage(){
        return view('landing-page');
    }

}
