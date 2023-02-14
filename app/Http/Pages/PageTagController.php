<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Base\Sites\Site;
use DDD\Domain\Pages\Page;

class PageTagController extends Controller
{
    public function tag(Site $site, Page $page, Request $request)
    {
        $page->tag(['accounts', 'checking']);

        return response()->json($page->tags);
    }

    public function untag(Site $site, Page $page, Request $request)
    {
        $page->untag();

        return response()->json($page->tags);
    }

    public function retag(Site $site, Page $page, Request $request)
    {
        $page->retag(['checking', 'share']);

        return response()->json($page->tags);
    }
}
