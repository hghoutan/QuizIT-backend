<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;
use Carbon\Carbon;
class PasswordResetController extends Controller
{

/***********token generating and sending mail for reset password************/  
public function sendResetPasswordLink(Request $request){
    try {
        // validation
        $request->validate([
            'email' => 'required|email',
        ]);

        $reqEmail = $request->email;

        // match user details
        $user = User::where('email', $reqEmail)->first();

        if (!$user) {
            return response([
                'status' => 'failed',
                'message' => 'Email doesn\'t exist'
            ], 404);
        }

        // Generate Token
        $token = Str::random(64);

        // save data to the database for password reset
        PasswordReset::create([
            'email' => $reqEmail,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // sending email 
        $userName = $user->name;
        $resetLink = url('/reset-password-page') . '?email=' . urlencode($reqEmail);
        Mail::send('mail.resetPassword', ['resetLink' => $resetLink, 'userName' => $userName], function(Message $message) use ($reqEmail) {
            $message->subject('Reset Your Password');
            $message->to($reqEmail);
        });

        return response([
            'status'=>'success',
            'message'=>'Check Your Email...... Reset your Password',
        ], 200);
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}

    public function resetPasswordForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }
/**********************reset password ***************************************/
// In your PasswordResetController.php

public function resetPassword(Request $request) {
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response([
                'message' => 'User not found',
                'status' => 'failed'
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response([
            'message' => 'Password Reset Success',
            'status' => 'success'
        ], 200);
    } catch (\Throwable $th) {
        return response([
            'message' => $th->getMessage(),
            'status' => 'failed'
        ], 500);
    }
}



}