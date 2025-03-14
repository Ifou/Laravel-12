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
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 dark:text-gray-400 uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $index => $post)
                            <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-mediumf text-gray-900 dark:text-white">
                                    {{ method_exists($posts, 'firstItem') ? $posts->firstItem() + $index : $index + 1 }}
                                </td>
                                <td class="px-6 py-4">{{ $post->title }}</td>
                                <td class="px-6 py-4">{{ $post->body }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end space-x-2">
                                        <flux:button size="sm" wire:click="edit({{ $post->id }})"
                                            variant="filled">Edit</flux:button>
                                        <flux:button size="sm" wire:click="delete({{ $post->id }})"
                                            variant="danger">Delete</flux:button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex justify-between items-center text-sm text-gray-600 dark:text-gray-400">
                <div>
                    @if ($posts->count())
                        @if (method_exists($posts, 'firstItem'))
                            Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }}
                            entries
                        @else
                            Showing {{ $posts->count() }} entries
                        @endif
                    @else
                        No entries found
                    @endif
                </div>
                <div class="flex space-x-1">
                    @if (method_exists($posts, 'links'))
                        {{ $posts->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
