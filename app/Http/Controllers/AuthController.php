<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display home page.
     */
    public function login(): View
    {
        return view('login');
    }

    public function signIn(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect(route('home'));
        } else return redirect(route('auth.login'))->withErrors([
            'email' => trans('auth.failed'),'password' => trans('auth.failed')
        ])->withInput();
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect(route('auth.login'));
    }
}
