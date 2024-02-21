<?php

namespace DDD\App\Console\Commands;

use Illuminate\Console\Command;
use DDD\Domain\Pages\PageJunkStatus;
use DDD\Domain\Pages\Page;

class UpdatePageJunkStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pages:update-junk-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of pages junk statuses';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pages = Page::all();

        foreach ($pages as $page) {
            $page->junkStatus()->associate(
                PageJunkStatus::firstWhere('slug', $page->junk_status)
            );
        }
    }
}
