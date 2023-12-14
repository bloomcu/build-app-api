<?php

namespace DDD\Http\Pages;

use DDD\Domain\Pages\Page;
use DDD\Domain\Pages\Actions\PredictPageJunk;
use DDD\Domain\Organizations\Organization;
use DDD\App\Controllers\Controller;

class PageJunkPredictController extends Controller
{
    public function predict(Organization $organization, Page $page)
    {
        $prediction = PredictPageJunk::run($page);
        
        return $prediction;
    }
}
