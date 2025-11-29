<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = ['title', 'synopsis', 'poster', 'year'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}