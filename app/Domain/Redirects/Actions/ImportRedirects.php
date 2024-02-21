<?php

namespace DDD\Domain\Redirects\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Collection;
use DDD\Domain\Organizations\Organization;
use DDD\App\Services\Url\UrlService;

class ImportRedirects
{
    use AsAction;
    
    /**
     * @param  Array  $crawlResults
     * @return string
     */
    function handle(Organization $organization, Collection $crawlResults): string
    {
        foreach ($crawlResults as $result) {
            if ($result['redirected']) {
                $cleanRequestedUrl = UrlService::getClean($result['requested_url']);

                $organization->redirects()->updateOrCreate(
                    ['requested_url' => $cleanRequestedUrl],
                    [
                        'title'           => $result['title'],
                        'requested_url'   => $cleanRequestedUrl,
                        'destination_url' => $result['url'],
                        'group'           => 'Old Website'
                    ]
                );
            }
        }
        
        return 'Redirects important from crawl results.';
    }
}