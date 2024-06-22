<div>
    <form wire:submit.prevent="create" class="space-y-6">
        <div wire:poll="updateRfid">
            {{ $this->form }}
        </div>

        <x-filament::button type="submit">
            Save
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</div>
