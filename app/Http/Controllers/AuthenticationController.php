<?php

namespace App\Http\Controllers;

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

        return LoginResource::make($user);
    }
}
