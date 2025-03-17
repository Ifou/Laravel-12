<div class="container mx-auto">
    <div class="relative">
        @if($movie['backdrop_path'])
            <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('{{ $this->getImageUrl($movie['backdrop_path'], 'original') }}')"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 dark:from-gray-950 via-gray-900/60 dark:via-gray-950/60 to-gray-900/0 dark:to-gray-950/0"></div>
        @endif
        
        <div class="relative z-10 flex flex-col md:flex-row gap-8 py-8">
            <div class="w-full md:w-1/3 lg:w-1/4 flex-shrink-0">
                @if($movie['poster_path'])
                    <img src="{{ $this->getImageUrl($movie['poster_path'], 'w500') }}" 
                         alt="{{ $movie['title'] }}" 
                         class="w-full h-auto rounded-lg shadow-lg" 
                         loading="lazy">
                @else
                    <div class="w-full aspect-[2/3] bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
            </div>
            
            <div class="flex-1">
                <h1 class="text-3xl md:text-4xl font-bold mb-2 text-gray-900 dark:text-white">
                    {{ $movie['title'] }}
                    <span class="text-2xl md:text-3xl text-gray-600 dark:text-gray-400">
                        ({{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }})
                    </span>
                </h1>
                
                <div class="flex flex-wrap items-center gap-4 mb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                        </svg>
                        <span class="ml-2 text-lg font-semibold">{{ number_format($movie['vote_average'], 1) }}/10</span>
                    </div>
                    
                    <div class="text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</div>
                    
                    <div class="text-gray-700 dark:text-gray-300">
                        @if($movie['runtime'])
                            {{ floor($movie['runtime'] / 60) }}h {{ $movie['runtime'] % 60 }}m
                        @endif
                    </div>
                </div>
                
                @if(!empty($movie['genres']))
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($movie['genres'] as $genre)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100 rounded-full text-sm">
                                {{ $genre['name'] }}
                            </span>
                        @endforeach
                    </div>
                @endif
                
                @if($movie['tagline'])
                    <p class="text-lg italic text-gray-600 dark:text-gray-400 mb-4">{{ $movie['tagline'] }}</p>
                @endif
                
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Overview</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ $movie['overview'] }}</p>
                </div>
                
                @if(isset($movie['credits']['cast']) && count($movie['credits']['cast']) > 0)
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Top Cast</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach(array_slice($movie['credits']['cast'], 0, 8) as $cast)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @if($cast['profile_path'])
                                            <img src="{{ $this->getImageUrl($cast['profile_path'], 'w200') }}" 
                                                alt="{{ $cast['name'] }}" 
                                                class="w-12 h-12 object-cover rounded-full">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                                <span class="text-xs text-gray-500">No image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $cast['name'] }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ $cast['character'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if(isset($movie['videos']['results']) && count($movie['videos']['results']) > 0)
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Videos</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach(array_filter($movie['videos']['results'], function($video) {
                                return $video['site'] === 'YouTube' && in_array($video['type'], ['Trailer', 'Teaser']);
                            }) as $video)
                                @if($loop->index < 2)
                                    <div class="aspect-w-16 aspect-h-9">
                                        <iframe 
                                            class="rounded-lg"
                                            src="https://www.youtube.com/embed/{{ $video['key'] }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen
                                            loading="lazy">
                                        </iframe>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @if(isset($movie['recommendations']['results']) && count($movie['recommendations']['results']) > 0)
        <div class="my-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">You might also like</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                @foreach(array_slice($movie['recommendations']['results'], 0, 6) as $recommendation)
                    <div wire:key="rec-{{ $recommendation['id'] }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105">
                        <button wire:click="$parent.loadMovieDetails({{ $recommendation['id'] }})" class="w-full text-left">
                            @if($recommendation['poster_path'])
                                <img 
                                    src="{{ $this->getImageUrl($recommendation['poster_path'], 'w300') }}" 
                                    alt="{{ $recommendation['title'] }}" 
                                    class="w-full h-auto object-cover" 
                                    loading="lazy">
                            @else
                                <div class="aspect-[2/3] w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No image</span>
                                </div>
                            @endif
                            <div class="p-2">
                                <h3 class="text-sm font-medium truncate">{{ $recommendation['title'] }}</h3>
                                <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                    </svg>
                                    <span class="ml-1">{{ number_format($recommendation['vote_average'], 1) }}</span>
                                </div>
                            </div>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
