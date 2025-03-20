<div>
    <flux:modal name="edit-post" class="md:max-w-2xl">
        <div class="space-y-6">
            <div class="text-center sm:text-left">
                <flux:heading size="lg">Edit Post</flux:heading>
                <flux:subheading>Update your post content and make it even better.</flux:subheading>
            </div>

            <div class="grid gap-6">
                <div>
                    <flux:input 
                        wire:model="title" 
                        label="Post Title" 
                        placeholder="Enter a descriptive title" 
                        helper="A clear title helps readers understand your content"
                        error="{{ $errors->first('title') }}"
                    />
                </div>

                <div>
                    <flux:textarea 
                        wire:model="body" 
                        label="Post Content" 
                        placeholder="Write your post content here..." 
                        rows="6"
                        helper="Express your ideas clearly and concisely"
                        error="{{ $errors->first('body') }}"
                    />
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>All fields are required. Changes will be immediately visible.</span>
                </div>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2 pt-4">
                <flux:modal.close>
                    <flux:button variant="outline" class="mt-3 sm:mt-0 w-full sm:w-auto">Cancel</flux:button>
                </flux:modal.close>

                <flux:button 
                    wire:click="update" 
                    type="submit" 
                    variant="primary"
                    class="w-full sm:w-auto flex items-center justify-center gap-2"
                    wire:loading.attr="disabled"
                >
                    <svg wire:loading wire:target="update" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="update">Save Changes</span>
                    <span wire:loading wire:target="update">Saving...</span>
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
