<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth/login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            return redirect()->route('posts.index');
        }

        return redirect()->route('auth.login-form');
    }

    public function registerForm()
    {
        return view('auth/register');
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('auth.login-form');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login-form');
    }
}
