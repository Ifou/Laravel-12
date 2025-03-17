<div>
    <flux:modal name="cms-edit" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Content</flux:heading>
                <flux:subheading>Edit and manage your content efficiently.</flux:subheading>
            </div>

            <form wire:submit="update">
                <div class="space-y-4">
                    <flux:input 
                        wire:model="title" 
                        label="Title" 
                        placeholder="Enter title" 
                    />

                    <flux:input 
                        wire:model="description" 
                        label="Description" 
                        type="textarea" 
                        placeholder="Enter description"
                    />

                    <div class="flex justify-end gap-3">
                        <flux:modal.close name="cms-edit">
                            <flux:button variant="outline">Cancel</flux:button>
                        </flux:modal.close>
                        <flux:button type="submit" variant="primary">Save changes</flux:button>
                    </div>
                </div>
            </form>
        </div>
    </flux:modal>
</div>