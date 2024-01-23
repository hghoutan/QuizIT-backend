<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'question', 'description', 'answers', 'correct_answer', 'explanation', 'tip', 'tags', 'category', 'difficulty', 'user_id',
    ];
    
    protected $casts = [
        'answers' => 'json',
        'tags' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
