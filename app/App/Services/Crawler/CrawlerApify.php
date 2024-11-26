<?php

namespace DDD\App\Services\Crawler;

use Illuminate\Support\Facades\Http;

use DDD\App\Services\Crawler\CrawlerInterface;

class CrawlerApify implements CrawlerInterface
{
    public function __construct(
        protected string $token,
        protected string $cheerioActor,
        protected string $puppeteerActor,
    ) {}

    public function crawlSite(string $url)
    {
        try {
            // $response = Http::post('https://api.apify.com/v2/actor-tasks/' . $this->cheerioActor . '/runs?token=' . $this->token, [
            $request = Http::post('https://api.apify.com/v2/acts/' . $this->cheerioActor . '/runs?token=' . $this->token, [
                'startUrls' => [['url' => $url . '/']],
                'pseudoUrls' => [['purl' => $url . '/[.*?]']]
            ])->json();

            $response = $request['data'];

            return [
                'crawl_id'   => $response['id'],
                'queue_id'   => $response['defaultRequestQueueId'],
                'results_id' => $response['defaultDatasetId'],
            ];
        } catch (\Exception $exception) {
            abort(500, 'Could not start Apify crawler: ' . $exception->getMessage());
        }
    }

    public function getStatus(string $crawlId, string $queueId)
    {
        try {
            $run = Http::get('https://api.apify.com/v2/actor-runs/' . $crawlId . '?token=' . $this->token)->json();
            $queue = Http::get('https://api.apify.com/v2/request-queues/' . $queueId . '?token=' . $this->token)->json();

            return [
                'status'  => $run['data']['status'],
                'total'   => $queue['data']['totalRequestCount'],
                'handled' => $queue['data']['handledRequestCount'],
                'pending' => $queue['data']['pendingRequestCount'],
            ];
        // } catch (RequestException $exception) {
        } catch (\Exception $exception) {
            abort(500, 'Could not retrieve status from Apify crawler: ' . $exception->getMessage());
        }
    }

    public function getResults(string $datasetId)
    {
        try {
            $request = Http::get('https://api.apify.com/v2/datasets/' . $datasetId . '/items?token=' . $this->token)->json();

            // Only return results with a url
            $collection = collect($request);
            $filtered = $collection->filter(function ($item) {
                return isset($item['url']);
            });

            $mapped = $filtered->map(function ($item) {
                return [
                    'http_status'   => $item['#debug']['statusCode'] ?? null,
                    'title'         => $item['title'] ?? null,
                    'wordcount'     => $item['wordcount'] ?? null,
                    'redirected'    => $item['redirected'] ?? null,
                    'requested_url' => $item['requested_url'] ?? null,
                    'url'           => $item['url'] ?? null,
                    // 'destination_url' => $item['destination_url'],
                ];
            });

            return $mapped;
        // } catch (RequestException $exception) {
        } catch (\Exception $exception) {
            abort(500, 'Could not get Apify crawl results: ' . $exception->getMessage());
        }
    }

    public function abortCrawl(string $crawlId)
    {
        try {
            $request = Http::post('https://api.apify.com/v2/actor-runs/' . $crawlId . '/abort?token=' . $this->token)->json();
            return $request;
        // } catch (RequestException $exception) {
        } catch (\Exception $exception) {
            abort(500, 'Could not abort Apify crawler: ' . $exception->getMessage());
        }
    }
}
