<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'category', 'difficulty_level'];

    /**
     * Get the user that owns the set.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the flashcards for the set.
     */
    public function flashcards()
    {
        return $this->hasMany(Flashcard::class);
    }
}
