<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'     => $request->string('email'),
            'email'    => $request->string('email'),
            'password' => Hash::make($request->string('password')),
        ]);

        $user->formSurvey()->create();
        $user->load('formSurvey');

        return LoginResource::make($user);
    }

    public function login(LoginRequest $request)
    {
        $user = User::with('formSurvey')
            ->where('email', $request->validated('email'))
            ->firstOrFail();

        if (!Hash::check($request->validated('password'), $user->password)) {
            abort(401, 'Invalid credentials');
        }

        return LoginResource::make($user);
    }
}
