@extends('layout')

@section('content')
    <form method="post" action="{{route('posts.update',['post'=>$post])}}">
        @csrf
        @method('PUT')
        <label>Title
            <input name="title" value="{{$post->title}}">
        </label>
        <label>Content
            <textarea name="content">
                {{$post->content}}
            </textarea>
        </label>
        <button type="submit">save</button>
    </form>
@endsection
