<x-layouts.app title="Dashboard">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Content Management') }}</flux:heading>
        <div class="flex justify-between items-center mb-6">
            <flux:subheading size="lg">{{ __('Efficiently manage, organize, and optimize your content resources.') }}</flux:subheading>
            {{-- <flux:modal.trigger name="cms-add">
                <flux:button>Add Content</flux:button>
            </flux:modal.trigger> --}}
        </div>
        <flux:separator variant="subtle" />
    </div>
    <livewire:cms.cms />
</x-layouts.app>