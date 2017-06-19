<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use App\Http\Requests\SendMessageRequest;
use Illuminate\Http\Request;
use Auth;

class MessagesController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
    	$this->messageRepository = $messageRepository;
    }

    public function create(SendMessageRequest $request)
    {
    	$attributes = 
    	[
    		'to_user_id' => $request->get('to'),
    		'from_user_id' => Auth::guard('api')->user()->id,
    		'body' => $request->get('body'),
            'dialog_id' => time().Auth::id()
    	];
    	if($this->messageRepository->create($attributes))
    	{
    		return response()->json(['sent'=>true]);
    	}
    	 return response()->json(['sent'=>false]);
    }
}
