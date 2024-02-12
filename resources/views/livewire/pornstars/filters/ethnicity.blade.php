<div class="flex items-center gap-2">
    <label for="ethnicity" class="text-sm font-bold">Ethnicity</label>
    <select
        id="ethnicity"
        wire:model.live="selectedEthnicity"
        class="border border-gray-300 rounded-lg p-2 flex-grow"
    >
        <option value="All">All</option>
        @foreach($ethnicities as $ethnicity)
            <option value="{{ $ethnicity->id }}">{{ $ethnicity->value }}</option>
        @endforeach
    </select>
</div>
