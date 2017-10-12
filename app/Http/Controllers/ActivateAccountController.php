<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ActivateAccountController extends Controller
{
    public function activateAccount($value){
        $user = User::where('confirmation_code','=',$value)->first();
        $user->confirmation_status = "true";
        $user->save();
        
         return redirect('/verify');
    }

    public function showVerifyPage(){
        return view('/verify');
    }
    
}
