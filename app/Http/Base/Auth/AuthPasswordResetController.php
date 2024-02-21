<?php

namespace DDD\Http\Base\Auth;

use DDD\App\Controllers\Controller;
use DDD\Http\Base\Auth\Requests\AuthPasswordResetRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
// Requests
use Illuminate\Support\Str;

class AuthPasswordResetController extends Controller
{
    public function __invoke(AuthPasswordResetRequest $request): JsonResponse
    {
        $status = Password::reset(
            $request->only('token', 'email', 'password', 'password_confirmation'),

            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'Password successfully reset.',
            ], 200);
        } else {
            return response()->json([
                'message' => 'There was a problem resetting the password.',
                'errors' => [
                    'password' => [
                        'Password reset requests expire after 60 minutes. Please start over.',
                    ],
                ],
            ], 422);
        }
    }
}
