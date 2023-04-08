<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.register');
        }

        $user = User::create([
            'name'     => $request->string('email'),
            'email'    => $request->string('email'),
            'password' => Hash::make($request->string('password')),
        ]);

        $user->formSurvey()->create();
        $user->load('formSurvey');

        return $request->wantsJson() ? LoginResource::make($user) : redirect()->route('form.edit', $user->formSurvey);
    }

    public function login(LoginRequest $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.login');
        }

        $user = User::with('formSurvey')
            ->where('email', $request->validated('email'))
            ->firstOrFail();

        if (!Hash::check($request->validated('password'), $user->password)) {
            abort(401, 'Invalid credentials');
        }

        if (!$request->wantsJson()) {
            Auth::login($user);
        }

        return $request->wantsJson() ? LoginResource::make($user) : redirect()->route('form.edit', $user->formSurvey);
    }
}
