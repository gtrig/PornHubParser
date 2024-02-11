<div class="w-10/12 justify-center max-w-7xl mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Pornstars</h1>
    </div>
    <div class="mt-4">
        {{ $this->pornstars->links() }}
        <ul wire:model="pornstars" class="flex flex-row flex-wrap gap-2">
            @foreach($this->pornstars as $pornstar)
                <li class="flex justify-between  border-b py-2">
                    <div class="flex flex-col gap-2">
                        <div class="w-36 h-38">
                            @if ($pornstar->hasImage())
                                <img
                                    src="/storage/thumbnails/{{ $pornstar->generateImagePath() }}"
                                    alt="{{ $pornstar->name }}"
                                    class="w-36 h-38 object-cover rounded-lg"
                                />
                            @else
                                <img
                                    src="/storage/thumbnails/noimage.jpg"
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
                            <a href="{{ $pornstar->link }}">See PH page</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $this->pornstars->links() }}
    </div>
</div>
