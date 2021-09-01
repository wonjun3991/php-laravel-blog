@extends('layout')

@section('content')
    <form method="post" action="{{route('posts.store')}}">
        @csrf
        <label>Title
            <input name="title">
        </label>
        <label>Content
            <textarea name="content">

            </textarea>
        </label>
        <button type="submit">save</button>
    </form>
@endsection
