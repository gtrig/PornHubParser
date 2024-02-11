<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadImageJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $url,
        private string $path
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if(!Storage::disk('public')->exists($this->path)) {
            try {
                Storage::disk('public')->put($this->path , file_get_contents($this->url));
            } catch (\Exception $e) {}
        }
    }
}
