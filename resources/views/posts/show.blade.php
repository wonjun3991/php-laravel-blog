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
        <button onclick="location.href='{{route('posts.edit',['post'=>$post])}}'">
            Edit Post
        </button>
    </div>
    <div>
        @foreach($post->comments as $comment)
            <div>
                {{$comment->content}}
            </div>
        @endforeach
        @include('comments.form',['post'=>$post])
    </div>
@endsection
