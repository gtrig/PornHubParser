<?php

namespace App\Console\Commands;

use App\Services\JsonParserService;
use Illuminate\Console\Command;

class UpdateFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating feed...');
        $start = microtime(true);
        $jps = new JsonParserService();
        $startSegment = microtime(true);
        $this->info('Downloading feed...');
        $jps->downloadFeed('https://www.pornhub.com/files/json_feed_pornstars.json');
        $endSegment = microtime(true);
        $this->info('Feed downloaded in ' . round($endSegment - $startSegment, 2) . ' seconds');
        $startSegment = microtime(true);
        $this->info('Updating types...');
        $jps->updateTypes();
        $endSegment = microtime(true);
        $this->info('Types updated in ' . round($endSegment - $startSegment, 2) . ' seconds');

        $startSegment = microtime(true);
        $this->info('Parsing pornstars...');

        $pornstars = $jps->parsePornstars();

        $endSegment = microtime(true);
        $this->info('Parsed '.$pornstars.' pornstars in ' . round($endSegment - $startSegment, 2) . ' seconds');
        $end = microtime(true);
        $this->info('Job finished in ' . round($end - $start, 2) . ' seconds');

        $this->info('Feed updated successfully');
    }
}
