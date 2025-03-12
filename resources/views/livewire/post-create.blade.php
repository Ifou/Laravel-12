<div>
    <flux:modal.trigger name="create-post">
        <flux:button>Edit profile</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-post" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add Details</flux:heading>
                <flux:subheading>Create your personal details.</flux:subheading>
            </div>

            <flux:input label="title" placeholder="Title" />

            <flux:textarea label="body" type="body" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
