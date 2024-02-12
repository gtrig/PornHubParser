<div class="flex flex-col gap-2">
    <label for="age" class="text-sm font-bold">Age</label>
    <div class="flex flex-row items-center gap-2">
        <label for="ageFrom" class="text-sm font-bold w-10">From</label>
        <input id="ageFrom" wire:model.live.debounce.300ms="ageFrom" type="number" class="border border-gray-300 rounded-lg p-2" />
    </div>
    <div class="flex flex-row items-center gap-2">
        <label for="ageTo" class="text-sm font-bold w-10">To</label>
        <input id="ageTo" wire:model.live.debounce.300ms="ageTo" type="number" class="border border-gray-300 rounded-lg p-2" />
    </div>
</div>
