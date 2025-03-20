<x-layouts.app title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-2 lg:grid-cols-2">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 bg-gradient-to-br from-blue-50 to-blue-100 dark:border-neutral-700 dark:from-blue-900/30 dark:to-indigo-900/30">
                <div class="absolute inset-0 size-full flex flex-col items-center justify-center p-4">
                    <h3 class="text-2xl font-bold text-blue-700 dark:text-blue-300">Users</h3>
                    <p class="text-4xl font-semibold text-blue-800 dark:text-blue-200">{{ \App\Models\User::count() }}</p>
                    
                    @php
                        // Extract user related logic to keep the template clean
                        $userService = app(\App\Services\DashboardService::class);
                        $userData = $userService->getUsersData();
                    @endphp
                    
                    <div class="mt-3 w-full h-24">
                        <!-- User Visualization -->
                        <div class="flex items-center justify-center h-full">
                            <div class="flex flex-wrap items-center justify-center gap-2.5">
                                <!-- Current user (if logged in) -->
                                @if($userData['currentUser'])
                                    <div class="relative tooltip-trigger" data-tooltip="{{ $userData['currentUser']->name }}">
                                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-blue-600 text-white dark:bg-blue-500 ring-2 ring-blue-200 dark:ring-blue-700">
                                            @if($userData['currentUser']->name)
                                                <span class="text-xs font-medium">{{ $userData['currentUser']->initials() }}</span>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 border-2 border-white rounded-full dark:border-gray-800"></span>
                                    </div>
                                @endif
                                
                                <!-- Other users -->
                                @foreach($userData['users'] as $index => $user)
                                    <div class="relative tooltip-trigger" data-tooltip="{{ $user->name }}">
                                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-{{ $userData['colors'][$index % 4] }} text-white dark:bg-{{ $userData['colors'][$index % 4] }}/80">
                                            @if($user->name)
                                                <span class="text-xs font-medium">{{ $user->initials() }}</span>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        @if($user->isOnline())
                                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 border-2 border-white rounded-full dark:border-gray-800"></span>
                                        @endif
                                    </div>
                                @endforeach
                                
                                <!-- Placeholder for empty state -->
                                @if(empty($userData['users']) && !$userData['currentUser'])
                                    @for($i = 0; $i < min(5, $userData['totalCount']); $i++)
                                        <div class="relative">
                                            <div class="flex items-center justify-center w-9 h-9 rounded-full bg-{{ $userData['colors'][$i % 4] }}/70 text-white dark:bg-{{ $userData['colors'][$i % 4] }}/50">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                
                                <!-- More users indicator -->
                                @if($userData['remainingCount'] > 0)
                                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-blue-100 text-blue-800 text-xs font-medium dark:bg-blue-900/40 dark:text-blue-300">
                                        +{{ $userData['remainingCount'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-center text-sm text-blue-700 dark:text-blue-300 pt-2">
                            <div class="flex items-center justify-center gap-1.5">
                                <span class="inline-block w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                                <span>
                                    {{ $userData['onlineCount'] }} 
                                    @if($userData['currentUser'] && $userData['onlineCount'] <= 1) (You) @endif 
                                    online now
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 bg-gradient-to-tr from-emerald-50 to-green-100 dark:border-neutral-700 dark:from-emerald-900/30 dark:to-green-900/30">
                <div class="absolute inset-0 size-full flex flex-col items-center justify-center p-4">
                    <h3 class="text-2xl font-bold text-emerald-700 dark:text-emerald-300">Posts</h3>
                    <p class="text-4xl font-semibold text-emerald-800 dark:text-emerald-200">{{ \App\Models\Post::count() }}</p>
                    
                    @php
                        $postService = app(\App\Services\DashboardService::class);
                        $postData = $postService->getPostsData();
                    @endphp
                    
                    <div class="mt-3 w-full h-24">
                        <!-- Post Visualization - Improved Bar Chart -->
                        <div class="flex justify-center h-full">
                            <div class="w-full max-w-[220px] flex justify-between items-end">
                                @foreach($postData['categories'] as $category)
                                    <div class="flex flex-col items-center">
                                        <div class="w-14 bg-{{ $category['color'] }} dark:bg-{{ $category['darkColor'] }}"
                                             style="height: {{ $category['height'] }}px; border-radius: 4px 4px 0 0;">
                                            <div class="h-full w-full flex items-center justify-center">
                                                <span class="text-xs font-semibold text-{{ $category['textColor'] }}">{{ $category['count'] }}</span>
                                            </div>
                                        </div>
                                        <div class="mt-1 text-xs text-emerald-700 dark:text-emerald-300 font-medium">
                                            {{ $category['name'] }}
                                        </div>
                                        <div class="text-xs text-emerald-600 dark:text-emerald-400">
                                            {{ $category['percentage'] }}%
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 bg-gradient-to-tr from-amber-50 to-yellow-100 dark:border-neutral-700 dark:from-amber-900/30 dark:to-yellow-900/30">
                <div class="absolute inset-0 size-full flex flex-col items-center justify-center p-4">
                    <h3 class="text-2xl font-bold text-amber-700 dark:text-amber-300">Movies</h3>
                    <p class="text-4xl font-semibold text-amber-800 dark:text-amber-200">{{ \App\Models\Movie::count() }}</p>
                    
                    @php
                        $movieService = app(\App\Services\DashboardService::class);
                        $movieData = $movieService->getMoviesData();
                    @endphp
                    
                    <div class="mt-3 w-full h-24">
                        <!-- Movie Visualization - Pie Chart -->
                        <div class="flex justify-center h-full">
                            <div class="relative w-24 h-24">
                                <!-- Pie chart visualization -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="relative w-full h-full">
                                        @php
                                            $startDeg = 0;
                                        @endphp
                                        
                                        @foreach($movieData['ratingCategories'] as $index => $category)
                                            @php
                                                $deg = 3.6 * $category['percentage'];
                                                $endDeg = $startDeg + $deg;
                                                
                                                // Create a conic gradient segment
                                                $style = "background: conic-gradient(transparent {$startDeg}deg, var(--tw-gradient-from) {$startDeg}deg, var(--tw-gradient-to) {$endDeg}deg, transparent {$endDeg}deg);";
                                                
                                                $startDeg = $endDeg;
                                            @endphp
                                            
                                            <div class="absolute inset-0 rounded-full from-{{ $category['color'] }} to-{{ $category['color'] }}" style="{{ $style }}"></div>
                                        @endforeach
                                        
                                        <!-- Inner circle (donut hole) -->
                                        <div class="absolute inset-0 m-auto w-12 h-12 bg-amber-50 dark:bg-amber-900/30 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-medium text-amber-800 dark:text-amber-200">{{ $movieData['totalCount'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Legend -->
                            <div class="ml-4 flex flex-col justify-center">
                                @foreach($movieData['ratingCategories'] as $category)
                                    <div class="flex items-center mb-1">
                                        <div class="w-3 h-3 rounded-full bg-{{ $category['color'] }} dark:bg-{{ $category['darkColor'] }} mr-2"></div>
                                        <div>
                                            <span class="text-xs font-medium text-amber-800 dark:text-amber-300">{{ $category['name'] }}</span>
                                            <span class="text-xs text-amber-600 dark:text-amber-400 ml-1">({{ $category['percentage'] }}%)</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 bg-gradient-to-tr from-purple-50 to-indigo-100 dark:border-neutral-700 dark:from-purple-900/30 dark:to-indigo-900/30">
                <div class="absolute inset-0 size-full flex flex-col items-center justify-center p-4">
                    <h3 class="text-2xl font-bold text-purple-700 dark:text-purple-300">CMS</h3>
                    <p class="text-4xl font-semibold text-purple-800 dark:text-purple-200">{{ \App\Models\Cms::count() }}</p>
                    
                    @php
                        $cmsService = app(\App\Services\DashboardService::class);
                        $cmsData = $cmsService->getCmsData();
                    @endphp
                    
                    <div class="mt-3 w-full h-24">
                        <!-- CMS Visualization - Improved Icon Grid -->
                        <div class="flex items-center justify-center h-full">
                            <div class="grid grid-cols-4 gap-3">
                                @foreach($cmsData['contentTypes'] as $type)
                                    <div class="flex flex-col items-center">
                                        <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-purple-100 dark:bg-purple-900/40 transition-all hover:bg-purple-200 dark:hover:bg-purple-800/40 relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                                                stroke="currentColor" class="w-5 h-5 text-purple-600 dark:text-purple-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $type['icon'] }}" />
                                            </svg>
                                            
                                            <!-- Count badge -->
                                            <div class="absolute -top-2 -right-2 w-5 h-5 rounded-full bg-purple-500 dark:bg-purple-400 flex items-center justify-center">
                                                <span class="text-[10px] font-bold text-white">{{ $type['count'] }}</span>
                                            </div>
                                        </div>
                                        <div class="mt-1 text-xs text-purple-700 dark:text-purple-300 font-medium">
                                            {{ $type['name'] }}
                                        </div>
                                        <div class="text-[10px] text-purple-600 dark:text-purple-400">
                                            {{ $type['percentage'] }}%
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
