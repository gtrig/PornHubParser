<?php

namespace App\Jobs;

use App\Services\JsonParserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePornstarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    /**
     * Create a new job instance.
     */
    public function __construct(
        private $pornstarArray
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        JsonParserService::updatePornstar($this->pornstarArray);
    }
}
