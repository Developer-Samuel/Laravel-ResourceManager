<?php

namespace App\Services;

use App\Http\Controllers\Resources\StoreResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cookie;

use App\Models\User;

class AuthService
{
    public static function login(Request $request)
    {
        $key = $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw new \Exception('Too many login attempts. Please try again in 1 minute.', 429);
        }

        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            RateLimiter::hit($key);
            throw new \Exception('Incorrect data', 401);
        }

        RateLimiter::clear($key);

        $user->is_active = true;
        $user->save();

        if ($request->has('remember')) {
            Auth::login($user, true);
        } else {
            Auth::login($user);
        }

        return [
            'remember_token' => $request->has('remember') ? Auth::user()->getRememberToken() : null,
        ];
    }

    public static function signup(Request $request, StoreResource $resource)
    {
        $collectionName = 'users';

        return $resource($request, $collectionName);
    }

    public static function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (Cookie::has('remember_me')) {
            Cookie::queue(Cookie::forget('remember_me'));
        }

        return [
            'success' => true,
            'message' => 'Successfully logged out.',
        ];
    }
}
