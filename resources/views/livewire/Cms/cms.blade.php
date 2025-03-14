<div>
    <x-toast-notification />
    
    <div>
        <livewire:cms.cms-create />

        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <flux:heading size="lg">Content Management</flux:heading>
                    <div class="flex items-center bg-gray-100 dark:bg-gray-800 rounded-lg p-1">
                        <button wire:click="$set('gridLayout', 1)" 
                                class="p-1.5 rounded-md {{ $gridLayout == 1 ? 'bg-white dark:bg-gray-700 shadow' : 'text-gray-500 dark:text-gray-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <button wire:click="$set('gridLayout', 2)" 
                                class="p-1.5 rounded-md {{ $gridLayout == 2 ? 'bg-white dark:bg-gray-700 shadow' : 'text-gray-500 dark:text-gray-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                            </svg>
                        </button>
                        <button wire:click="$set('gridLayout', 3)" 
                                class="p-1.5 rounded-md {{ $gridLayout == 3 ? 'bg-white dark:bg-gray-700 shadow' : 'text-gray-500 dark:text-gray-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>
                @if (count($cms ?? []) > 0)
                    <flux:modal.trigger name="cms-add">
                        <flux:button variant="primary">Add New</flux:button>
                    </flux:modal.trigger>
                @endif
            </div>

            @if (count($cms ?? []) > 0)
                <div x-data x-transition class="grid-container">
                    @if($gridLayout == 1)
                        <!-- List View Layout -->
                        <div class="space-y-3 transform-gpu transition-all duration-300 ease-in-out">
                            @foreach ($cms as $content)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg">
                                    <div class="p-5">
                                        <div class="md:flex md:items-center md:justify-between">
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $content->title }}
                                                </h3>
                                                <p class="mt-2 text-gray-600 dark:text-gray-300">
                                                    {{ Str::limit($content->description, 200) }}
                                                </p>
                                            </div>
                                            <div class="mt-4 md:mt-0 md:ml-6 flex items-center gap-2">
                                                <flux:button wire:click="edit({{ $content->id }})" size="sm"
                                                    variant="outline">Edit</flux:button>
                                                <flux:modal.trigger name="confirm-delete-modal-{{ $content->id }}">
                                                    <flux:button size="sm" variant="danger">Delete</flux:button>
                                                </flux:modal.trigger>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Grid Layout (2 or 3 columns) -->
                        <div class="grid transform-gpu transition-all duration-300 ease-in-out {{ $gridLayout == 2 ? 'grid-cols-1 md:grid-cols-2' : 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3' }} gap-6">
                            @foreach ($cms as $content)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg flex flex-col h-full">
                                    <div class="p-5 flex-1 flex flex-col">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                            {{ $content->title }}</h3>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 flex-1">
                                            {{ Str::limit($content->description, $gridLayout == 2 ? 150 : 100) }}
                                        </p>
                                        <div class="flex justify-end gap-2 mt-auto">
                                            <flux:button wire:click="edit({{ $content->id }})" size="sm"
                                                variant="outline">Edit</flux:button>
                                            <flux:modal.trigger name="confirm-delete-modal-{{ $content->id }}">
                                                <flux:button size="sm" variant="danger">Delete</flux:button>
                                            </flux:modal.trigger>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Keep modals outside the grid but ensure IDs match triggers -->
                @foreach ($cms as $content)
                    <flux:modal name="confirm-delete-modal-{{ $content->id }}" id="modal-{{ $content->id }}">
                        <div class="rounded-lg shadow-lg p-5 max-w-md mx-auto">
                            <div class="flex items-center justify-center mb-4 text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <flux:heading size="lg" class="text-center mb-2">Confirm Delete</flux:heading>
                            <p class="text-center text-gray-600 dark:text-gray-400 mb-6">
                                Are you sure you want to delete "{{ $content->title }}"? This action cannot be
                                undone.
                            </p>
                            <div class="flex justify-center gap-3">
                                <flux:modal.close name="confirm-delete-modal-{{ $content->id }}">
                                    <flux:button variant="outline" size="sm">Cancel</flux:button>
                                </flux:modal.close>
                                <flux:button wire:click="delete({{ $content->id }}); $dispatch('close-modal', {name: 'confirm-delete-modal-{{ $content->id }}'})"
                                    variant="danger" size="sm">
                                    Delete
                                </flux:button>
                            </div>
                        </div>
                    </flux:modal>
                @endforeach
            @else
                <div class="text-center py-12">
                    <div class="text-gray-500 dark:text-gray-400">No content available yet.</div>
                    <div class="mt-4">
                        <flux:modal.trigger name="cms-add">
                            <flux:button variant="outline">Create Your First Content</flux:button>
                        </flux:modal.trigger>
                    </div>
                </div>
            @endif

            @if (isset($cms) && $cms->hasPages())
                <div class="mt-6">
                    {{ $cms->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
