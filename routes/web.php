<?php
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $test = '<span>hello world</span>';
    return view('welcome',compact('test'));
    //return DB::table('users')->value('email');
    //return DB::table('topics')->insertGetId([
        'name' => 'ttttt'
    ]);
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('email/verify/{confirmation_token}', 'EmailController@verifyEmail')->name('email.verify');
Route::resource('questions', 'QuestionController');

Route::post('questions/{question}/answer', 'AnswerController@store');

Route::get('questions/{question}/follow', 'QuestionFollowController@follow');

Route::get('notifications', 'NotificationController@index');
Route::get('inbox', 'InboxController@index');
Route::get('inbox/{dialogId}', 'InboxController@show');
Route::post('inbox/{dialogId}/reply', 'InboxController@reply');
