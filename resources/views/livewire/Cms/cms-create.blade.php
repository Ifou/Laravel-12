<div>
    <flux:modal name="cms-add" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add Content</flux:heading>
                <flux:subheading>Create and manage your content efficiently.</flux:subheading>
            </div>

            <flux:input wire:model="title" label="Title" placeholder="title" />

            <flux:input wire:model="description" label="description" type="textarea" />

            <div class="flex">
                <flux:spacer />

                <flux:button wire:click="submit" type="submit" variant="primary">submit</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
