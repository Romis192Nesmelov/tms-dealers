<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    public function login(): View
    {
        return view('admin.login');
    }

    public function signIn(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        $credentials['is_admin'] = 1;
        if (Auth::attempt($credentials, $request->remember == 'on')) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.home'));
        } else {
            return back()->withErrors(['email' => trans('auth.failed'), 'password' => trans('auth.failed')])->withInput();
        }
    }
}
