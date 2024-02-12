<div class="flex items-center gap-2">
    <label for="hairColor" class="text-sm font-bold">Hair Color</label>
    <select
        id="hairColor"
        wire:model.live="selectedHairColor"
        class="border border-gray-300 rounded-lg p-2 flex-grow"
    >
        <option value="All">All</option>
        @foreach($hairColors as $hairColor)
            <option value="{{ $hairColor->id }}">{{ $hairColor->value }}</option>
        @endforeach
    </select>
</div>
