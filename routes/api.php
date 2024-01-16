<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;



Route::post('/send-reset-password-link', [PasswordResetController::class, 'sendResetPasswordLink']);
Route::post('/reset-password/{token}', [PasswordResetController::class, 'resetPassword']);

Route::group(['middleware' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
        
});

