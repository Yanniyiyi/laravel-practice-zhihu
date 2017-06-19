@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List</div>

                <div class="panel-body">
                    <form action="/inbox/{{$dialogId}}/reply" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div> 
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">Reply</button>
                        </div>
                    </form>
                   <div class="message-list">
                        @foreach($messages as $message)
                        <div class="media">
                            <div class="media-left">
                                <a href="">
                                        <img src="{{$message->fromUser->avatar}}" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                        <a href="">{{$message->fromUser->name}}</a>
                                </h4>
                                <p>
                                   {{$message->body}} <span class="pull-right">{{ $message->created_at->format('Y-m-d')}}</span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
