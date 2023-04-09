<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->append(['token' => $token]);

        if (!$request->wantsJson()) {
            Auth::login($user);
            Session::put('token', $token);
        }

        return $request->wantsJson() ? LoginResource::make($user) : redirect()->route('form.edit', $user->formSurvey);
    }

    public function logout(Request $request)
    {
        if ($request->wantsJson()) {
            $request->user()->currentAccessToken()->delete();

            return response()->json(['message' => 'Logged out successfully']);
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
