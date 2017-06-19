<?php
namespace App\Repositories;
use App\Question;
use App\Topic;
use App\Answer;
use App\Comment;


class CommentRepository
{
	public function create($attributes)
	{
		return Comment::create($attributes);
	}
}