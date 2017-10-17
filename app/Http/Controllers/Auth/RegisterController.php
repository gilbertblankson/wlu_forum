<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\ActivateAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/sign-up';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:30',
            'lastname' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'street_name' => 'required|string|max:100',
        ]);
    }

    /*
     * Generate activation code
     * A hash using
     * random string  + current time + md5 of microtime
    */  

    protected function generateActivationCode(){
        
        $current_time = time();
        $random_string = md5(microtime());
        $string_to_hash = $random_string.$current_time;
        $final_code=$string_to_hash.str_random(20);

        return $final_code;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        $activation_code = $this->generateActivationCode();

        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'street_name' => $data['street_name'],
            'user_type' => 'N',
            'confirmation_code'=>$activation_code,
        ]);
    }


    public function register(Request $request){
       
        $this->validator($request->all())->validate(); //validate submission
        $new_user = $this->create($request->all()); //register user

        
       \Mail::to($new_user->email)->send(new ActivateAccount($new_user));
             

        session()->flash('message','Successfully registered. An account activation link has been sent to your email.');

        return redirect($this->redirectTo);
    }


}
