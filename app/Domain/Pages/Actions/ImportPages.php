<?php

namespace DDD\Domain\Pages\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Collection;
use DDD\Domain\Organizations\Organization;
use DDD\App\Services\Url\UrlService;
use DDD\Domain\Pages\Actions\PredictPageJunkBatch;

class ImportPages
{
    use AsAction;
    
    /**
     * @param  Array  $crawlResults
     * @return string
     */
    function handle(Organization $organization, Collection $crawlResults): string
    {
        foreach ($crawlResults as $crawlResult) {
            $cleanUrl = UrlService::getClean($crawlResult['url']);

            $organization->pages()->updateOrCreate(
                ['url' => $cleanUrl],
                [
                    'http_status'   => $crawlResult['http_status'],
                    'title'         => $crawlResult['title'],
                    'wordcount'     => $crawlResult['wordcount'],
                    'url'           => $cleanUrl,
                ]
            );
        }

        PredictPageJunkBatch::run($organization->pages);
        
        return 'Pages imported from crawl results.';
    }
}