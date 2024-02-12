<div class="flex flex-col gap-2">
    <div class="flex flex-row items-center gap-2">
        <label for="piercingsAll" class="text-sm font-bold">Piercings</label>
        <select id="piercingsAll" wire:model.live.debounce.300ms="piercings" class="border border-gray-300 rounded-lg p-2 flex-grow">
            <option value="All">All</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>
</div>
