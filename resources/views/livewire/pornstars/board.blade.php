<div class="w-10/12 justify-center max-w-7xl mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Pornstars</h1>
        <button x-on:click="darkMode = !darkMode" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
            <svg x-show="! darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    <div class="flex flex-row gap-2">
        <div class="flex flex-col gap-2 justify-between">
            <livewire:pornstars.filters />
        </div>
        <div class="mt-4 flex-grow">
            @if($pornstars==null)
                <p class="text-lg font-bold">No pornstars found</p>
            @else
            <div class="flex flex-row justify-between">
                <livewire:pornstars.sortBy />
                <div class="flex flex-row gap-2 items-center">
                    <label for="perPage" class="text-sm font-bold">Results Per Page</label>
                    <select
                        id="perPage"
                        wire:model.live="perPage"
                        class="border border-gray-300 rounded-lg p-2 flex-grow"
                    >
                        <option>6</option>
                        <option>12</option>
                        <option>18</option>
                        <option>24</option>
                        <option>32</option>
                        <option>64</option>
                    </select>
                </div>
            </div>
            <div class="pt-4">
            {{ $pornstars->links() }}
            </div>
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
