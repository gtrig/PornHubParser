<div class="flex items-center gap-2">
    <label for="orientation" class="text-sm font-bold">Orientation</label>
    <select
        id="orientation"
        wire:model.live="selectedOrientation"
        class="border border-gray-300 rounded-lg p-2 flex-grow"
    >
        <option value="All">All</option>
        @foreach($orientations as $orientation)
            <option value="{{ $orientation->id }}">{{ $orientation->value }}</option>
        @endforeach
    </select>
</div>
