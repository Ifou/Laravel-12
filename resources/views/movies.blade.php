<x-layouts.app title="Movie Database">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Movie Database') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Browse and search your favorite movies') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:movies.movies />    
</x-layouts.app>
