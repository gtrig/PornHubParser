<div class="flex flex-col gap-2">
    <button wire:click='toggleFilters'>
        <svg class="dark:fill-slate-100" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
            viewBox="0 0 51.913 51.913" xml:space="preserve">
            <path d="M50.957,7c0-4.596-12.577-7-25-7s-25,2.404-25,7c0,1.042,0.652,1.97,1.796,2.784l17.204,23.542v17.525l0.062,1.062h1
                l0.457-0.018l10.481-10.481v-8.088L49.16,9.784C50.305,8.97,50.957,8.042,50.957,7z M25.957,2c14.04,0,23,2.961,23,5s-8.96,5-23,5
                s-23-2.961-23-5S11.917,2,25.957,2z"/>
        </svg>
    </button>
    
    <div class="flex flex-col gap-2 transition-all duration-300 overflow-hidden @if(!$this->showFilters) opacity-0 scale-0 hidden  @endif">
        <livewire:pornstars.filters.search />
        <livewire:pornstars.filters.gender />
        <livewire:pornstars.filters.age />
        <livewire:pornstars.filters.hairColor />
        <livewire:pornstars.filters.ethnicity />
        <livewire:pornstars.filters.orientation />
        <livewire:pornstars.filters.breastType />
        <livewire:pornstars.filters.piercings />
        <livewire:pornstars.filters.tattoos />
    </div>
    
</div>
