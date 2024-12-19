<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AdminController;

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckGuest;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;

Route::middleware(CheckAuth::class)->group(function () {
    Route::get('/user', [UserController::class, 'fetchData']);
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'show']);
        Route::get('/edit', [UserController::class, 'edit']);
        Route::post('/update', [UserController::class, 'update']);
    });

    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'list']);
        Route::get('/create', [ProjectController::class, 'create']);
        Route::post('/store', [ProjectController::class, 'store']);
        Route::get('/show/{url}', [ProjectController::class, 'show']);
        Route::get('/edit/{url}', [ProjectController::class, 'edit']);
        Route::post('/update/{id}', [ProjectController::class, 'update']);
        Route::post('/delete', [ProjectController::class, 'delete']);
    });

    Route::middleware(IsAdmin::class)->prefix('admin')->group(function () {
        Route::get('/users', [AdminController::class, 'users']);
        Route::get('/projects/{userId}', [AdminController::class, 'projects']);
    });
});

Route::middleware(CheckGuest::class)->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [LoginController::class, 'show']);
        Route::post('/store', [LoginController::class, 'store']);
    });
    Route::prefix('signup')->group(function () {
        Route::get('/', [SignupController::class, 'show']);
        Route::post('/store', [SignupController::class, 'store']);
    });
});

Route::get('/', function () {
    return redirect(Auth::check() ? '/projects' : '/login');
});

Route::get('/{any}', function () {
    return Auth::check() ? redirect('/projects') : redirect('/login');
})
->where('any', '.*')
->middleware(HandleInertiaRequests::class);
