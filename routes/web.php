<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/reset-password-page', function () {
    return view('reset-password');
});

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('reset.password');

