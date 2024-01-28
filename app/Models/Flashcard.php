<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;

    protected $fillable = ['set_id', 'term', 'definition', 'image'];

    public function set()
    {
        return $this->belongsTo(Set::class);
    }
}
