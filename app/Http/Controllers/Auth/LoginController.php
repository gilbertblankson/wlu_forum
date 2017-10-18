<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/preview';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginPage(){
        return view('login');
    }

    public function login(){

        $this->validate(request(),[
            'email'=>'required|email|string|max:255',
            'password'=>'required',
        ]);

        if(auth()->attempt(['email'=>request('email'),'password'=>request('password'),'confirmation_status'=>'true'])){
            return redirect($this->redirectTo);
        }

        session()->flash('message','loginfailure');
        return redirect('/login');

    }

    public function logout(){
        auth()->logout();
        return redirect('login');
    }
}
