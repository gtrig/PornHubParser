<div>
    <div class="flex items-center">
        <label for="sort_by" class="mr-2">Sort by:</label>
        <select wire:model.live="sortBy" id="sort_by" class="border border-gray-300 rounded-lg p-2 flex-grow">>
            @foreach ($this->availableSorts as $key=>$sort)
                <option value="{{ $key }}">{{ $sort }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center">
        <label for="sort_dir" class="mr-2">Sort direction:</label>
        <select wire:model.live="sortDirection" id="sort_dir" class="border border-gray-300 rounded-lg p-2 flex-grow">>
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
    </div>
</div>
