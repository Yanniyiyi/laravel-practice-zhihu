<?php
namespace App\Mailer;

class UserEmail extends Mailer{
	public function sendVerifyEmail($user)
	{
		$this->sendEmail($user->email, 'RegisterVerifyEmail',$user);
	}
}