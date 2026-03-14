<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request) {
        $data = $request->validated();

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $data['email'])->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request) {
        $data = $request->validated();

        $user = User::create([
//            'name' => $request->name,
            'name' => $data['name'],
//            'email' => $request->email,
            'email' => $data['email'],
//            'password' => Hash::make($request->password)
            'password' => Hash::make($data['password'])
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ], 'User created succesfully');
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return $this->success('', 'Logged out successfully');
    }
}
