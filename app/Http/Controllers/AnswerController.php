<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;
use App\Http\Requests\StoreAnswerRequest;
use Auth;


class AnswerController extends Controller
{
	protected $answerRepository;

	public function __construct(AnswerRepository $answerRepository)
	{
		$this->answerRepository = $answerRepository;
	}
    //
    public function store(StoreAnswerRequest $request,$questionId)
    {
    	$answer = $this->answerRepository->create([
    			'question_id' => $questionId,
    			'user_id' => Auth::id(),
    			'body' => $request->get('body')
    		]);
    	$answer->question()->increment('answers_count');
    	return back();
    }
}
