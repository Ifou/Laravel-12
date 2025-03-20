<x-layouts.app title="Dashboard">
    {{-- <div class="relative mb-6 w-full">
        <div class="flex justify-between items-center">
            <div>
            <flux:heading size="xl" level="1">Posts</flux:heading>
            <flux:subheading size="lg">Manage Existing Posts</flux:subheading>
            </div>
            <div>
            <flux:modal.trigger name="create-post">
                <flux:button variant="primary">Add profile</flux:button>
            </flux:modal.trigger>
            </div>
        </div>
        <flux:separator variant="subtle" />
    </div> --}}
    <livewire:Posts.posts />
</x-layouts.app>
