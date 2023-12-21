<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    /**
     * Stores a new user in the database
     *
     * @param array $data
     * @return JsonResponse
     */
    public function save(array $data): JsonResponse
    {
        $user = new User();
        $user->name = $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        $user->save();

        return response()->json(['status' => 'ok', 'message' => 'Registration Successful']);
    }

}
