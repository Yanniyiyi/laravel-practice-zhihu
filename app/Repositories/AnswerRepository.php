<?php
namespace App\Repositories;
use App\Question;
use App\Topic;
use App\Answer;

class AnswerRepository
{
	public function create($attributes)
	{
		return Answer::create($attributes);
	}

	public function getAnswerCommentsById($id)
	{
		return Answer::with('comments','comments.user')->where('id',$id)->first();
	}
}