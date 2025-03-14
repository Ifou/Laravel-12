<div>
    <flux:modal name="create-post" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add Details</flux:heading>
                <flux:subheading>Create your personal details.</flux:subheading>
            </div>

            <flux:input wire:model="title" label="title" placeholder="Title" />

            <flux:textarea wire:model="body" label="body" type="body" />

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="submit" type="submit" variant="primary">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
