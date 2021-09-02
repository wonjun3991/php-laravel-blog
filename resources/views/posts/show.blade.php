@extends('layout')
@section('content')
    <h2>Post</h2>
    <div>
        <div>Title</div>
        <div>{{$post->title}}</div>
        <div>Content</div>
        <div>{{$post->content}}</div>
    </div>
    <div>
        @auth
            <button onclick="location.href='{{route('posts.edit',['post'=>$post])}}'">
                Edit Post
            </button>
        @endauth
    </div>
    <div>
        @foreach($post->comments as $comment)
            <div>
                {{$comment->content}}
            </div>
        @endforeach
        @auth
            @include('comments.form',['post'=>$post])
        @endauth
    </div>
@endsection
