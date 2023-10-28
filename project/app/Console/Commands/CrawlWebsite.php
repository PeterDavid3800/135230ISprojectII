<?php

namespace App\Console\Commands;

use App\Models\Crawler;
use App\Observer;
use Illuminate\Console\Command;

class CrawlWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Crawler::create()
        ->ignoreRobots()
        ->setCrawlObserver(new Observer)
        ->startCrawling('https://www.lipsum.com');
        return Command::SUCCESS;
    }
}
