<div class="container mx-auto px-4 py-8">
    @if($isLoading)
        <div class="flex justify-center items-center py-10">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
        </div>
    @else
        @if($viewMode === 'list')
            <div class="mb-6">
                <div class="flex space-x-4 items-center">
                    <div class="w-full">
                        <flux:input 
                            wire:model.live.debounce.500ms="searchQuery"
                            placeholder="Search movies..."
                            type="search"
                            class="w-full"
                        />
                    </div>
                </div>
            </div>

            @if(isset($moviesData['results']) && count($moviesData['results']) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($moviesData['results'] as $movie)
                        <div wire:key="{{ $movie['id'] }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105">
                            <button wire:click="loadMovieDetails({{ $movie['id'] }})" class="w-full">
                                @if($movie['poster_path'])
                                    <img src="{{ $this->getImageUrl($movie['poster_path']) }}" 
                                        alt="{{ $movie['title'] }}" 
                                        class="w-full h-80 object-cover" 
                                        loading="lazy">
                                @else
                                    <div class="w-full h-80 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-400">No image available</span>
                                    </div>
                                @endif
                                <div class="p-4 text-left">
                                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">{{ $movie['title'] }}</h3>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                                        </span>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                            </svg>
                                            <span class="text-sm font-semibold ml-1">{{ number_format($movie['vote_average'], 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between items-center mt-8">
                    <flux:button 
                        wire:click="prevPage" 
                        disabled="{{ $currentPage <= 1 ? 'true' : 'false' }}"
                        variant="{{ $currentPage <= 1 ? 'subtle' : 'solid' }}"
                    >
                        Previous
                    </flux:button>

                    <span class="px-4 py-2 rounded-md bg-gray-100 dark:bg-gray-700">
                        Page {{ $currentPage }} of {{ $moviesData['total_pages'] }}
                    </span>

                    <flux:button 
                        wire:click="nextPage"
                        disabled="{{ $currentPage >= $moviesData['total_pages'] ? 'true' : 'false' }}"
                        variant="{{ $currentPage >= $moviesData['total_pages'] ? 'subtle' : 'solid' }}"
                    >
                        Next
                    </flux:button>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12">
                    <p class="text-xl text-gray-600 dark:text-gray-400">No movies found</p>
                    @if(!empty($searchQuery))
                        <flux:button wire:click="$set('searchQuery', '')" class="mt-4">Clear search</flux:button>
                    @endif
                </div>
            @endif
        @else
            @if($selectedMovie)
                <div>
                    <flux:button wire:click="backToList" class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to movies
                    </flux:button>
                    
                    @livewire('movies.movie-details', ['movie' => $selectedMovie], key($selectedMovie['id']))
                </div>
            @else
                <div class="text-center py-12">
                    <p>Movie not found</p>
                    <flux:button wire:click="backToList" class="mt-4">Back to movies</flux:button>
                </div>
            @endif
        @endif
    @endif
</div>
