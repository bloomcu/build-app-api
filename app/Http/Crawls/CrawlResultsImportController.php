<?php

namespace DDD\Http\Crawls;

use DDD\Domain\Redirects\Actions\ImportRedirects;
use DDD\Domain\Pages\Actions\ImportPages;
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Crawls\Crawl;
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;
use DDD\App\Controllers\Controller;


class CrawlResultsImportController extends Controller
{
    public function import(Organization $organization, Crawl $crawl, Crawler $crawler)
    {
        $crawlResults = $crawler->getResults($crawl->results_id);

        ImportPages::run($organization, $crawlResults);
        ImportRedirects::run($organization, $crawlResults);

        return response()->json([
            'message' => 'Pages and redirects imported from crawl results.',
        ]);
    }
}
