<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //
    protected $table = 'user_question';
    protected $fillable = ['user_id', 'question_id'];
}
