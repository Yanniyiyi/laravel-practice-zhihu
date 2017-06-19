<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class EmailController extends Controller
{
    //
    public function verifyEmail($token){
    	$user = User::where('confirmation_token',$token)->first();
    	if(is_null($user))
    	{
            flash('Invalid verify link')->error();
    		return redirect('/');
    	}

    	$user->confirmation_token = str_random(40);
    	$user->is_active  = 1;
    	$user->save();

    	Auth::login($user);
        flash("Welcome back, ".$user->name." .")->success();
    	return redirect('/home'); 
    }
}
