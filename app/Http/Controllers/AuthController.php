<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(): Factory|View|Application
    {
        return view('auth/login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            return redirect()->route('posts.index');
        }

        return redirect()->route('auth.login-form');
    }

    public function registerForm(): Factory|View|Application
    {
        return view('auth/register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('auth.login-form');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login-form');
    }
}
