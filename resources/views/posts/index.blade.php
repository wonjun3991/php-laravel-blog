@extends('layout')

@section('content')
    @foreach($posts as $post)
        <div>
            <h3>Post</h3>
            <div>
                <a href="{{route('posts.show',['post'=>$post])}}">{{$post->title}}</a>
            </div>
            <div>{{$post->content}}</div>
            <h4>{{$post->title}}'s Comments</h4>
            @foreach($post->comments as $comment)
                <div>{{$comment->content}}</div>
            @endforeach
        </div>
    @endforeach
    @auth
    <div>
        <button onclick="location.href='{{route('posts.create')}}'">Create Post</button>
    </div>
    @endauth
@endsection
