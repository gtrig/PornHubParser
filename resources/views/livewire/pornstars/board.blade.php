<div class="w-10/12 justify-center max-w-7xl mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Pornstars</h1>
    </div>
    <div class="flex flex-row gap-2">
        <div class="flex flex-col gap-2 justify-between">
            <livewire:pornstars.filters />
        </div>
        <div class="mt-4">
            @if($pornstars==null)
                <p class="text-lg font-bold">No pornstars found</p>
            @else
            <div class="flex flex-row justify-between">
            <livewire:pornstars.sortBy />
                <div class="flex flex-row gap-2  items-center">
                    <label for="perPage" class="text-sm font-bold">Results Per Page</label>
                    <select
                        id="perPage"
                        wire:model.live="perPage"
                        class="border border-gray-300 rounded-lg p-2 flex-grow"
                    >
                        <option>6</option>
                        <option>12</option>
                        <option>24</option>
                        <option>32</option>
                        <option>64</option>
                    </select>
                </div>
            </div>
            {{ $pornstars->links() }}
            <ul class="flex flex-row flex-wrap gap-2 justify-between my-2">
                @foreach($pornstars as $pornstar)
                    <li class="flex justify-between  border-b py-2">
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('pornstars.view', $pornstar->name) }}" class="text-lg font-bold">
                                <div class="w-36 h-38">
                                    @if ($pornstar->hasImage())
                                        <img
                                            src="/storage/thumbnails/{{ $pornstar->generateImagePath() }}"
                                            alt="{{ $pornstar->name }}"
                                            class="w-36 h-38 object-cover rounded-lg"
                                        />
                                    @else
                                        <img
                                            src="/storage/thumbnails/noimage.png"
                                            alt="{{ $pornstar->name }}"
                                            class="w-36 h-38 object-cover rounded-lg py-8"
                                        />
                                    @endif
                                    
                                </div>
                                <div class="text-wrap">
                                    <p class="text-lg font-bold text-wrap">{{ $pornstar->name }}</p>
                                    @if($pornstar->age)
                                    <p class="text-sm">{{ $pornstar->age }} years old</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $pornstars->links() }}
            @endif
        </div>
    </div>
</div>
