<?php

namespace DDD\Domain\Pages\Actions;

use Throwable;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Collection;
use Illuminate\Bus\Batch;
use DDD\Domain\Pages\Page;
use DDD\Domain\Pages\Actions\PredictPageJunk;

class PredictPageJunkBatch
{
    use AsAction;
    
    /**
     * @param  Page  $page
     * @return string
     */
    function handle(Collection $pages): Batch
    {
        $jobs = $pages->map(function($page) {
            return PredictPageJunk::makeJob($page);
        });

        $batch = Bus::batch($jobs)->then(function (Batch $batch) {
            // All jobs completed successfully...
        })->catch(function (Batch $batch, Throwable $e) {
            // First batch job failure detected...
        })->finally(function (Batch $batch) {
            // The batch has finished executing...
        })->dispatch();

        return $batch;
    }
}