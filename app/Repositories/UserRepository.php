<?php
namespace App\Repositories;
use App\Question;
use App\Topic;
use App\User;

class UserRepository
{
	public function byId($userId)
	{
		return User::find($userId);
	}

}