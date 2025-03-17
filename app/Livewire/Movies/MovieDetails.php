<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use App\Services\TmdbService;

class MovieDetails extends Component
{
    public $movie;
    
    public function mount($movie)
    {
        $this->movie = $movie;
    }
    
    public function getImageUrl($path, $size = 'w500')
    {
        $tmdbService = new TmdbService();
        return $tmdbService->getImageUrl($path, $size);
    }
    
    public function render()
    {
        return view('livewire.movies.movie-details');
    }
}
