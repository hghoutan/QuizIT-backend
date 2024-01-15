<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    public $table = 'password_resets';

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];
    
    // If you want to include the 'updated_at' timestamp
    // public $timestamps = true;
    
    // If you don't want to include the 'updated_at' timestamp
    // public $timestamps = false;
}
