<div class="w-10/12 justify-center max-w-7xl mx-auto pt-10">
    <div class="flex justify-between items-center">
        <div class="flex flex-row gap-2">
            <div class="w-36 h-38">
                @if ($this->pornstar->hasImage())
                    <img
                        src="/storage/thumbnails/{{ $this->pornstar->generateImagePath() }}"
                        alt="{{ $this->pornstar->name }}"
                        class="w-36 h-38 object-cover rounded-lg"
                    />
                @else
                    <img
                        src="/storage/thumbnails/noimage.png"
                        alt="{{ $this->pornstar->name }}"
                        class="w-36 h-38 object-cover rounded-lg py-8"
                    />
                @endif
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row gap-4 pt-40 items-center">
                    <h1 class="text-2xl font-bold">{{ $this->pornstar->name }}</h1>
                    @if($this->pornstar->age)
                    <p class="text-sm">{{ $this->pornstar->age }} years old</p>
                    @endif
                    
                    @if($this->pornstar->hairColor)
                    {{-- <p class="text-sm">Hair Color: {{ implode(', ', ) }}</p> --}}
                    <p class="text-sm">Hair Color: {{$this->pornstar->hairColor->pluck('value')->implode(', ')}}</p>
                    <p class="text-sm">Ethnicity: {{$this->pornstar->ethnicity->pluck('value')->implode(', ')}}</p>
                    
                    @endif
                    
                    <a href="{{$this->pornstar->link}}" target="_blank" class="text-blue-500"> Go to Pornhub</a>
                </div>
                <div>
                    Aliases: {{ $this->pornstar->aliases->pluck('name')->implode(', ') }}
                </div>
            </div>
        </div>  
    </div>
    <div>
        <h2 class="text-lg font-bold">Statistics</h2>
        <div class="flex flex-col gap-2">
            <p class="text-sm">Rank: {{ $this->pornstar->stats->rank }}</p>
            <p class="text-sm">Rank Premium: {{ $this->pornstar->stats->rankPremium }}</p>
            <p class="text-sm">Monthly Searches: {{ $this->pornstar->stats->monthlySearches }}</p>
            <p class="text-sm">Views: {{ $this->pornstar->stats->views }}</p>
            <p class="text-sm">Free Videos: {{ $this->pornstar->stats->videosCount }}</p>
            <p class="text-sm">Premium Videos: {{ $this->pornstar->stats->premiumVideosCount }}</p>
            <p class="text-sm">Weekly Rank: {{ $this->pornstar->stats->rankWl }}</p>
            <p class="text-sm">Subscribers: {{ $this->pornstar->stats->subscriptions }}</p>
        </div>
    </div>
</div>