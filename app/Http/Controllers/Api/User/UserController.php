<?php

namespace App\Http\Controllers\Api\User;

use App\Api\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    use ResponseTrait;

    public function register(UserRegisterRequest $request)
    {
        $credentials = $request->validated();

        $user = new User($credentials);

        $user->save();

        return $this->ok(201, 'User Registered!', $user);
    }

    public function login(UserLoginRequest $request)
    {
        $email = $request->email;

        $password = $request->password;

        $credentials = User::where('email', $email)->first();

        if (!is_null($credentials) && Hash::check($password, $credentials->password)) {

            $token = $credentials->createToken($credentials->id)->plainTextToken;

            return $this->ok(200, 'User Signed In!', $token);
        } else {

            return $this->error(422, 'Invalidated Credentials');
        }
    }

    public function logout(Request $request)
    {
        $bear = $request->bearerToken();

        $token = PersonalAccessToken::findToken($bear);

        if (is_null($token)) {
            return $this->error(400, 'User Already Logged Out!');
        }

        $token->tokenable->tokens()->delete();

        return $this->ok(200, 'User Logged Out!');
    }
}
