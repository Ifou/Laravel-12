<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use App\Services\TmdbService;
use Livewire\WithPagination;

class Movies extends Component
{
    use WithPagination;
    
    public $searchQuery = '';
    public $currentPage = 1;
    public $selectedMovie = null;
    public $isLoading = false;
    public $viewMode = 'list'; // 'list' or 'details'
    
    protected $queryString = [
        'searchQuery' => ['except' => ''],
        'currentPage' => ['except' => 1],
        'viewMode' => ['except' => 'list']
    ];

    public function mount()
    {
        if ($this->viewMode === 'details' && request()->has('movie_id')) {
            $this->loadMovieDetails(request()->movie_id);
        }
    }
    
    public function updatedSearchQuery()
    {
        $this->resetPage();
    }
    
    public function loadMovieDetails($movieId)
    {
        $this->isLoading = true;
        $tmdbService = new TmdbService();
        $this->selectedMovie = $tmdbService->getMovieDetails($movieId);
        $this->viewMode = 'details';
        $this->isLoading = false;
    }
    
    public function backToList()
    {
        $this->viewMode = 'list';
        $this->selectedMovie = null;
    }

    public function getImageUrl($path, $size = 'w500')
    {
        $tmdbService = new TmdbService();
        return $tmdbService->getImageUrl($path, $size);
    }
    
    public function nextPage()
    {
        $this->currentPage++;
    }
    
    public function prevPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }
    
    public function render()
    {
        $this->isLoading = true;
        $tmdbService = new TmdbService();
        
        $moviesData = [];
        
        if (!empty($this->searchQuery)) {
            $moviesData = $tmdbService->searchMovies($this->searchQuery, $this->currentPage);
        } else {
            $moviesData = $tmdbService->getTopRatedMovies($this->currentPage);
        }
        
        $this->isLoading = false;
        
        return view('livewire.movies.movies', [
            'moviesData' => $moviesData
        ]);
    }
}
