<div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

        <livewire:Posts.post-create />
        <livewire:Posts.post-edit />

        <flux:modal name="delete-post" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete post?</flux:heading>

                    <flux:subheading>
                        <p>You're about to delete this post.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:subheading>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" wire:click="destroy()" variant="danger">Delete post</flux:button>
                </div>
            </div>
        </flux:modal>

        <div class="p-6">
            <!-- Header with search and create button -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Posts</h2>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <div class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" wire:model.live.debounce.300ms="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search posts..." />
                    </div>
                    <flux:modal.trigger name="create-post" class="whitespace-nowrap">
                        <flux:button  variant="primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>    
                            New Post
                        </flux:button>
                    </flux:modal.trigger>
                </div>
            </div>

            @if ($posts->count())
                <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-200">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium">ID</th>
                                <th scope="col" class="px-6 py-4 font-medium">Title</th>
                                <th scope="col" class="px-6 py-4 font-medium">Description</th>
                                <th scope="col" class="px-6 py-4 text-right font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($posts as $index => $post)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ method_exists($posts, 'firstItem') ? $posts->firstItem() + $index : $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 font-medium">{{ $post->title }}</td>
                                    <td class="px-6 py-4">{{ Str::limit($post->body, 100) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end space-x-2">
                                            <flux:button size="sm" wire:click="edit({{ $post->id }})" variant="outline" class="inline-flex items-center transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </flux:button>
                                            <flux:button size="sm" wire:click="delete({{ $post->id }})" variant="danger" class="inline-flex items-center transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </flux:button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600 dark:text-gray-400">
                    <div class="mb-4 sm:mb-0">
                        @if (method_exists($posts, 'firstItem'))
                            <span class="font-medium">Showing</span> {{ $posts->firstItem() }} <span class="font-medium">to</span> {{ $posts->lastItem() }} <span class="font-medium">of</span> {{ $posts->total() }} entries
                        @else
                            <span class="font-medium">Showing</span> {{ $posts->count() }} entries
                        @endif
                    </div>
                    <div class="flex space-x-1">
                        @if (method_exists($posts, 'links'))
                            {{ $posts->links() }}
                        @endif
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No posts available</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new post.</p>
                    <div class="mt-6">
                        <flux:modal.trigger name="create-post" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create New Post
                        </flux:modal.trigger>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
