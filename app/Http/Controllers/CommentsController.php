<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\Comment;
use Auth;
use App\Repositories\QuestionRepository;
use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;

class CommentsController extends Controller
{
	protected $answerRepo;
	protected $questionRepo;
	protected $commentRepo;

	public function __construct(AnswerRepository $answerRepo, QuestionRepository $questionRepo, CommentRepository $commentRepo){
		$this->answerRepo = $answerRepo;
		$this->questionRepo = $questionRepo;
		$this->commentRepo =$commentRepo;
	}

    public function answer($id)
    {
    	return $this->answerRepo->getAnswerCommentsById($id);
    }

    public function question($id)
    {
    	return $this->questionRepo->getQuestionCommentsById($id);
    }

    public function create()
    {
    	$type = $this->getModelNameFromType(request('type'));

    	return $this->commentRepo->create([
    			'commentable_id' => request('model'),
    			'commentable_type' => $type,
    			'body' => request('body'),
    			'user_id' => Auth::guard('api')->user()->id
    		]);
    }

    public function getModelNameFromType($type)
    {
    	return $type === 'question' ? 'App\Question' : 'App\Answer';
    }
}
