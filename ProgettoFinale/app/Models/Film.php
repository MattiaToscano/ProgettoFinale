<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title',
        'description',
        'release_year',
        'duration_minutes',
        'director',
        'rating',
        'poster_url'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}