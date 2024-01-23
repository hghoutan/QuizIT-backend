<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Api\QuizController;

Route::post('/send-reset-password-link', [PasswordResetController::class, 'sendResetPasswordLink']);
Route::post('/reset-password/{token}', [PasswordResetController::class, 'resetPassword']);


Route::group(['middleware' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
        Route::resource('quizzes', QuizController::class);
    });

});



