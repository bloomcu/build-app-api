<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Pages\Page;

// Requests
use DDD\Domain\Pages\Requests\PageNestingRequest;

class PageNestingController extends Controller
{
    public function update(Organization $organization, Page $page, PageNestingRequest $request)
    {
        $page->update([
            'parent_id' => $request->parent_id,
            'order' => $request->order
        ]);

        return response()->json([
            'message' => 'Page nesting successfully updated.',
        ], 200);
    }
}
