@extends('layout')

@section('content')
    <form method="post" action="{{ route('auth.login') }}">
        @csrf
        <label>Email
            <input name="email" type="email">
        </label>
        <label>Password
            <input name="password" type="password">
        </label>
        <button type="submit">Save</button>
    </form>
@endsection
