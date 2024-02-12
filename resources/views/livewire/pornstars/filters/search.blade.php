<div class="flex flex-row items-center gap-2">
    <label for="search" class="text-sm font-bold w-10">Search</label>
    <input
        type="text"
        id="search"
        wire:model.live="search"
        wire:model.debounce.500ms="search"
        class="border border-gray-300 rounded-lg p-2"
    />
</div>