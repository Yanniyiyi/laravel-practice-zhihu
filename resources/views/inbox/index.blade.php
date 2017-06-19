@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Notifications</div>

                <div class="panel-body">

                    @foreach($messages as $key => $messageGroups)
                        @foreach($messageGroups as $messageGroup)
                            <div class="media">
                            <div class="media-left">
                                <a href="">
                                    @if(Auth::id() == $key)
                                        <img src="{{$messageGroup->fromUser->avatar}}" alt="">
                                    @else
                                        <img src="{{$messageGroup->toUser->avatar}}" alt="">
                                    @endif
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    @if(Auth::id() == $key)
                                        <a href="">From: {{$messageGroup->fromUser->name}}</a>
                                    @else
                                        <a href="">To: {{$messageGroup->toUser->name}}</a>
                                    @endif
                                </h4>
                                <p>
                                     @if(Auth::id() == $messageGroup->from_user_id)
                                       <a href="/inbox/{{$messageGroup->dialog_id}}">You: {{$messageGroup->body}}</a>
                                    @else
                                       <a href="/inbox/{{$messageGroup->dialog_id}}">{{$messageGroup->fromUser->name}}: {{$messageGroup->body}}</a>
                                    @endif
                                    
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
