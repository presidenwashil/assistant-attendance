<div>
    <form wire:submit="save">
        <div x-data="{ nokartu: '' }"
             x-init="setInterval(() => {
                 fetch('/nokartu')
                 .then(response => response.text())
                 .then(data => nokartu = data);
             }, 2000)">
            <div x-html="nokartu"></div>
        </div>

        <input type="text" wire:model="code">

        <input type="text" wire:model="name">

        <button type="submit">Save</button>
    </form>
</div>
