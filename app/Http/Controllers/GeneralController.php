<?php

namespace App\Http\Controllers;

use App\User;
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

    public function showPasswordResetPage(){
        return view('password-reset');
    }

    public function resetPassword(){
        $this->validate(request(),[
            'email'=>'email|required',
        ]);

        if(User::where('email','=',request('email'))->where('confirmation_status', '=', '1')->exists()){
            //generate new password
            //update password in db
            //email new password
            $user = User::where('email','=',request('email'))->first();
            $new_password = substr($user->firstname,0,2).time();
            $user->password = bcrypt($new_password);

            $user->save();

            \Mail::send('emails.reset',['password'=>$new_password],function($message){
                $message->from("info@walulel.com",'Walulel');
                $message->to(request('email'))->subject('Walulel Password Reset');
            });

            session()->flash('success', 'good');
            return redirect('/password-reset');

        }

        session()->flash('message','illegal');
        return redirect('/password-reset');

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
