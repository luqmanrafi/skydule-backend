<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')
        ->redirect()
        ->scopes(['openid', 'profile', 'email', 'https://www.googleapis.com/auth/classroom.courses.readonly', 'https://www.googleapis.com//auth/classroom.coursework.me'])
        ->stateless();
    }

    public function handleGoogleCallback(){
        try{
            $googleUser = Socialite::driver('google')->user();
            $user = User::firstOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
            ]);
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ]);
        } catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage()], 500);
        }
    }
}
