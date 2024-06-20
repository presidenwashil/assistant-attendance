<div>
    <form wire:submit="save">
        <div wire:poll="updateRfid">
            <input wire:model="rfid" type="text" placeholder="Tempelkan Kartu pada perangkat" readonly
                autocomplete="off">
        </div>

        <input type="text" wire:model="code">

        <input type="text" wire:model="name">

        <button type="submit">Save</button>
    </form>
</div>
