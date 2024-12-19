<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cookie;

use App\Services\AuthService;

class LoginController extends Controller
{
    public function show()
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request)
    {
        try {
            $result = AuthService::login($request);

            $response = [
                'success' => true,
                'message' => 'Login successful!',
            ];

            if (isset($result['remember_token'])) {
                $rememberDuration = 60 * 24 * 30;
                Cookie::queue('remember_me', encrypt($result['remember_token']), $rememberDuration);
            }

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $statusCode);
        }
    }

    public function logout(Request $request)
    {
        try {
            $result = AuthService::logout($request);

            return response()->json($result, 200);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $statusCode);
        }
    }
}
