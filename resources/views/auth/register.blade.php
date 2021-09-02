@extends('layout')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('auth.register') }}">
        @csrf
        <label>Name
            <input name="name">
        </label>
        <label>Email
            <input name="email" type="email">
        </label>
        <label>Password
            <input name="password" type="password">
        </label>
        <button type="submit">Save</button>
    </form>
@endsection
