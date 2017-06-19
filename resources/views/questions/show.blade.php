@extends('layouts.app')
@include('vendor.ueditor.assets')
@section('content')
	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$question->title}}
                    @foreach($question->topics as $topic)
                        <a href="/topic/{{$topic->id}}" class="pull-right label label-primary" style="margin-right: 5px">{{$topic->name}}</a>
                    @endforeach
                </div>
                
                <div class="panel-body">
                    <div>
                        {!!$question->body!!}
                    </div>
                     <div class="actions">
                    @if(Auth::check() && Auth::user()->owns($question))
                        <a class="btn btn-primary btn-sm" href="/questions/{{$question->id}}/edit">Edit</a> 
                        <form action="/questions/{{$question->id}}" method="post" style="display:inline">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary btn-sm">Delete</button>                         
                        </form>
                    @endif
                    <comments type="question" model="{{$question->id}}" count="{{$question->comments_count}}"></comments>
                </div>
                </div>           
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>{{$question->followers_count}} Followers</h2>
                </div>
                <div class="panel-body">
                    <question-follow-button question="{{$question->id}}"></question-follow-button>
                    <a href="#editor" class="btn btn-default">Answer</a>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($question->answers_count == 0)
                        Be the first one to answer this question.
                    @else
                        {{ $question->answers_count }} answers
                    @endif
                  
                </div>
                <div class="panel-body">
                     @foreach($question->answers as $answer)
                        <div class="media">
                            <div class="media-left">
                                <a href="">
                                    <img class="img-rounded" style="width:40px" src="{{ $answer->user->avatar }}" alt="{{ $answer->user->name }}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="/users/{{ $answer->user->id }}">{{ $answer->user->name }}</a>
                                </h4>
                                {!! $answer->body!!}
                            </div>
                        </div>
                        <vote-answer-button answer="{{$answer->id}}"></vote-answer-button>
                        <comments type="answer" model="{{$answer->id}}" count="{{$answer->comments()->count()}}"></comments>
                    @endforeach
                    @if(Auth::check())
                    <form action="/questions/{{$question->id}}/answer" method="post">
                        {!!csrf_field()!!}
                        <div class="form-group">
                             <script id="container" name="body" type="text/plain">
                                 {!!old('body')!!}
                             </script>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default pull-right" type="submit">
                                Submit Answer
                            </button>
                        </div>
                        <div class="form-group">
                            @if($errors->has('body'))
                                <span class="help-block">
                                    {{$errors->first('body')}}
                                </span>
                            @endif
                        </div>
                    </form>
                    @else
                    <a href="/login" class="btn btn-primary">Login to submit your answer</a>
                    @endif
                </div> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>About author</h5>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left"><a href=""><img class="img-rounded" width="36px" src="{{$question->user->avatar}}" alt="{{$question->user->name}}"></a></div>
                        <div class="media-body">
                            <h4><a href="">{{$question->user->name}}</a></h4>
                        </div>
                    </div>
                    <div style="text-align: center;display: flex;">
                        <div style="padding: 2px 10px">
                            <div>Questions</div>
                            <div>{{$question->user->questions_count}}</div>
                        </div>
                        <div style="padding: 2px 10px">
                            <div>Answers</div>
                            <div>{{$question->user->answers_count}}</div>
                        </div>
                        <div style="padding: 2px 10px">
                            <div>Followers</div>
                            <div>{{$question->user->followers_count}}</div>
                        </div>
                    </div>
                    
                    <user-follow-button user="{{$question->user->id}}"></user-follow-button>
                    <send-message-button to="{{$question->user->id}}"></send-message-button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', Laravel.csrfToken); // 设置 CSRF token.
    });
</script>
@endsection