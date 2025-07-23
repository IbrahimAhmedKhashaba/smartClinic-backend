<?php

namespace App\Http\Controllers\Api\Doctor\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\Auth\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function login(AuthRequest $request)
    {

        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return ApiResponse::success([
            'token' => $token,
            'user' => new UserResource($user),
        ] , __('custom.login_successful'), 200);
    }

    public function profile(Request $request) {
        return new UserResource($request->user());
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return ApiResponse::success( [], __('custom.logout_successful'), 200);
    }
}
