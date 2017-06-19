<?php
namespace App\Mailer;
use Mail;
use App\Mail\RegisterVerifyEmail;
class Mailer 
{
    public function sendEmail($emailAddress,$emailClass,$attributes=null)
    {
    	Mail::to($emailAddress)->queue(new $emailClass($attributes));
    }
}
