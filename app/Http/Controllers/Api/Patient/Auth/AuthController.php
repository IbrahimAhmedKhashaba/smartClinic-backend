<?php

namespace App\Http\Controllers\Api\Patient\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Auth\RegisterRequest;
use App\Http\Requests\Doctor\Auth\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request)
    {
        $user = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return ApiResponse::success([
            'token' => $token,
            'user' => new UserResource($user),
        ], __('custom.login_successful'), 200);
    }
    public function login(AuthRequest $request)
    {
        $user = Patient::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return ApiResponse::success([
            'token' => $token,
            'user' => new UserResource($user),
        ], __('custom.login_successful'), 200);
    }

    public function profile(Request $request)
    {
        return new UserResource(Auth::guard('patient')->user());
    }

    public function logout(Request $request)
    {
        auth('patient')->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
