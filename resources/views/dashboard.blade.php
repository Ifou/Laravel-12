<x-layouts.app title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 bg-gradient-to-br from-blue-50 to-blue-100 dark:border-neutral-700 dark:from-blue-900/30 dark:to-indigo-900/30">
                <div class="absolute inset-0 size-full flex flex-col items-center justify-center p-4">
                    <h3 class="text-2xl font-bold text-blue-700 dark:text-blue-300">Users</h3>
                    <p class="text-4xl font-semibold text-blue-800 dark:text-blue-200">{{ \App\Models\User::count() }}</p>
                    <div class="mt-2 w-3/4 h-12">
                        <div class="flex items-end justify-between h-full">
                            @foreach(range(1, 8) as $i)
                                <div class="w-1/9 bg-blue-500 dark:bg-blue-400" style="height: {{ rand(20, 100) }}%;"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 bg-gradient-to-tr from-emerald-50 to-green-100 dark:border-neutral-700 dark:from-emerald-900/30 dark:to-green-900/30">
                <div class="absolute inset-0 size-full flex flex-col items-center justify-center p-4">
                    <h3 class="text-2xl font-bold text-emerald-700 dark:text-emerald-300">Posts</h3>
                    <p class="text-4xl font-semibold text-emerald-800 dark:text-emerald-200">{{ \App\Models\Post::count() }}</p>
                    <div class="mt-2 w-3/4 h-12">
                        <svg viewBox="0 0 100 20" class="w-full h-full">
                            <path d="M0,10 Q10,{{ rand(5, 15) }},20,{{ rand(5, 15) }} T40,{{ rand(5, 15) }} T60,{{ rand(5, 15) }} T80,{{ rand(5, 15) }} T100,{{ rand(5, 15) }}" 
                                  fill="none" stroke="currentColor" class="stroke-emerald-500 dark:stroke-emerald-400" stroke-width="2" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
