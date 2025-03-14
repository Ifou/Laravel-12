<div>
    <flux:modal name="edit-post" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Post</flux:heading>
                <flux:subheading>Edit your personal details.</flux:subheading>
            </div>

            <flux:input wire:model="title" label="title" placeholder="Title" />

            <flux:textarea wire:model="body" label="body" type="body" />

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="update" type="submit" variant="primary">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
