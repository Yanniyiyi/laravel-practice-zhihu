<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
    public function follow($question)
    {
    	Auth::user()->followThisQuestion($question);
    	return back();
    }
}
