<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials) and auth()->user()->admin_is == NULL) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return redirect(route('admin'));
        };
        throw ValidationException::withMessages([
            'email' => 'These credentials do not math our records.']);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}