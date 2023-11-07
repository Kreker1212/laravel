<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(): view
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): Redirector
    {
        $user = $request->validated();

        $user = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password']
        ]);

        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
