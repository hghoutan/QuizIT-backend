<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::post('/forget-password', [AuthController::class, 'forgetPassword']);

Route::post('/resetPassword', [MailController::class, 'send']);
Route::get('/resetPassword', [MailController::class, 'send']);

Route::group(['middleware' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
        
});

