<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tmdb_id',
        'title',
        'overview',
        'poster_path',
        'release_date',
        'vote_average',
        'popularity',
        'backdrop_path'
    ];
    
    /**
     * Get movie rating category
     *
     * @return string
     */
    public function getRatingCategory(): string
    {
        if ($this->vote_average >= 8.0) {
            return 'High Rated';
        } elseif ($this->vote_average >= 6.0) {
            return 'Medium';
        } else {
            return 'Low Rated';
        }
    }
}