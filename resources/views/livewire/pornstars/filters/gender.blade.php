<div class="flex items-center gap-2">
    <label for="gender" class="text-sm font-bold">Gender</label>
    <select
        id="gender"
        wire:model.live="selectedGender"
        class="border border-gray-300 rounded-lg p-2 flex-grow"
    >
        <option value="All">All</option>
        @foreach($genders as $gender)
            <option value="{{ $gender->id }}">{{ $gender->value }}</option>
        @endforeach
    </select>
</div>
