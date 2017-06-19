<?php

use Illuminate\Http\Request;
use App\User;
use App\Question;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/topics', function (Request $request) {
   	$topics = \App\Topic::select(['id','name'])
   			  ->where('name','like','%'.$request->query('q').'%')
   			  ->get();
   	return $topics;
});

// check if current user followed the question
Route::middleware('auth:api')->post('/question/follower', function (Request $request) {
    $result = Auth::guard('api')->user()->followedThisQuestion($request->get('question'));
    return response()->json(['followed'=>$result]);
});

// toggle follow
Route::middleware('auth:api')->post('/question/follow', function (Request $request) {
    $result =  Auth::guard('api')->user()->toggleFollowQuestion($request->get('question'));
    return response()->json(['followed'=>$result]);
});

// check if current user followed the question
Route::middleware('auth:api')->post('/user/followed', function (Request $request) {
    $result = Auth::guard('api')->user()->followedThisUser($request->get('user'));
    return response()->json(['followed'=>$result]);
});

// toggle follow
Route::middleware('auth:api')->post('/user/follow', function (Request $request) {
    $result =  Auth::guard('api')->user()->toggleFollowUser($request->get('user'));
    return response()->json(['followed'=>$result]);
});

// check if current user followed the question
Route::middleware('auth:api')->post('/answer/voted', function (Request $request) {
    $result = Auth::guard('api')->user()->votedThisAnswer($request->get('answer'));
    return response()->json(['voted'=>$result]);
});

// toggle follow
Route::middleware('auth:api')->post('/answer/vote', function (Request $request) {
    $result =  Auth::guard('api')->user()->toggleVoteFor($request->get('answer'));
    return response()->json(['voted'=>$result]);
});

Route::middleware('auth:api')->post('/message', 'MessagesController@create');

Route::middleware('auth:api')->get('/answer/{id}/comments', 'CommentsController@answer');
Route::middleware('auth:api')->get('/question/{id}/comments', 'CommentsController@question');
Route::middleware('auth:api')->get('/comment', 'CommentsController@create');
Route::middleware('auth:api')->post('/comment', 'CommentsController@create');
