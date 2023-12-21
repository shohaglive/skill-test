<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginService
{
    /**
     * Checks if the user exits and matches the password and send response accordingly
     *
     * @param array $data
     * @return JsonResponse
     */
    public function login(array $data): JsonResponse
    {
        $user = User::select('password')->where('email', $data['email'])->first();

        if (!empty($user)) {
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember'])) {

                return response()->json(
                    ['status' => 'ok', 'message' => 'Hello User, you are logged in as ' . $data['email']]
                );
            } else {
                return response()->json(['status' => 'fail', 'message' => 'Login Failed! Wrong Password.']);
            }
        }

        return response()->json(['status' => 'fail', 'message' => 'User Not Found!']);
    }

    /**
     * Destroy current session
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['status' => 'ok', 'message' => 'Logout is successful!']);
    }

}
