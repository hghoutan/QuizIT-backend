<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Api\SetController;

use App\Http\Controllers\Api\FlashcardController;
use App\Http\Controllers\Api\QuizController;

Route::post('/send-reset-password-link', [PasswordResetController::class, 'sendResetPasswordLink']);
Route::post('/reset-password/{token}', [PasswordResetController::class, 'resetPassword']);


Route::group(['middleware' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);

});
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
        Route::resource('quizzes', QuizController::class);
    });

Route::middleware('auth:api')->group(function () {
    Route::resource('/sets', SetController::class);
});

// Flashcard Routes
Route::middleware('auth:api')->group(function () {
    // Get all flashcards for a specific set
    Route::get('/sets/{set}/flashcards', [FlashcardController::class, 'index']);

    // Get a specific flashcard
    Route::get('/flashcards/{flashcard}', [FlashcardController::class, 'show']);

    // Create a new flashcard for a specific set
    Route::post('/sets/{set}/flashcards', [FlashcardController::class, 'store']);

    // Update a specific flashcard
    Route::put('/flashcards/{flashcard}', [FlashcardController::class, 'update']);

    // Delete a specific flashcard
    Route::delete('/flashcards/{flashcard}', [FlashcardController::class, 'destroy']);
});
