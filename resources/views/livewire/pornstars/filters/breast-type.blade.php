<div>
    <label for="breastType" class="text-sm font-bold">Breast Type</label>
    <select
        id="breastType"
        wire:model.live="selectedBreastType"
        class="border border-gray-300 rounded-lg p-2"
    >
        <option value="All">All</option>
        @foreach($breastTypes as $breastType)
            <option value="{{ $breastType->id }}">{{ $breastType->value }}</option>
        @endforeach
    </select>
</div>
