<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ActivationToken;
use App\Models\User;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function activate($token)
    {
        $activationToken = ActivationToken::where('token', $token)->first();

        if (!$activationToken) {
            return response()->json(['message' => 'Invalid activation token'], 404);
        }

        $user = $activationToken->user;
        $user->email_verified_at = now();
        $user->save();

        // Delete the activation token after successful activation
        $activationToken->delete();

        return response()->json(['message' => 'User activated successfully'], 200);
    }
}
