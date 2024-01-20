<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;

Route::post('/send-reset-password-link', [PasswordResetController::class, 'sendResetPasswordLink']);
Route::post('/reset-password/{token}', [PasswordResetController::class, 'resetPassword']);

Route::group(['middleware' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');

});



