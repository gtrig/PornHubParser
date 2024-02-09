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
        $jps = new JsonParserService();
        $jps->downloadFeed('https://www.pornhub.com/files/json_feed_pornstars.json');
        $jps->updateTypes();
        

        $this->info('Feed updated successfully');
    }
}
