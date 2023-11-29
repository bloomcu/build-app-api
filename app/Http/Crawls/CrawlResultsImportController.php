<?php

namespace DDD\Http\Crawls;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Crawls\Crawl;

// Services
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;
use DDD\App\Services\Url\UrlService;

class CrawlResultsImportController extends Controller
{
    public function import(Organization $organization, Crawl $crawl, Crawler $crawler)
    {
        $results = $crawler->getResults($crawl->results_id);

        // Import pages
        foreach ($results as $result) {
            $cleanUrl = UrlService::getClean($result['url']);

            $organization->pages()->updateOrCreate(
                ['url' => $cleanUrl],
                [
                    'http_status'   => $result['http_status'],
                    'title'         => $result['title'],
                    'wordcount'     => $result['wordcount'],
                    'url'           => $cleanUrl,
                ]
            );
        }

        // Import redirects
        foreach ($results as $result) {
            if ($result['redirected']) {
                $organization->redirects()->updateOrCreate(
                    ['requested_url' => $result['requested_url']],
                    [
                        'title'           => $result['title'],
                        'requested_url'   => $result['requested_url'],
                        'destination_url' => $result['url'],
                        'group'           => 'Old Website'
                    ]
                );
            }
        }

        return response()->json([
            'message' => 'Crawl results imported.',
        ]);
    }
}
