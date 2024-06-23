<div>
    <form wire:submit="create">
        <div wire:poll="updateRfid">
            {{ $this->form }}
        </div>

        <x-filament::button type="submit">
            Save
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</div>
