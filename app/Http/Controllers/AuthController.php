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
        $validatedData = $request->validated();

        if (Auth::attempt($validatedData)) {
            return redirect()->route('posts.index');
        }
        return redirect()->back();
    }

    public function registerForm()
    {
        return view('auth/register');
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->saveOrFail();

        return redirect()->route('auth.login-form');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login-form');
    }
}
