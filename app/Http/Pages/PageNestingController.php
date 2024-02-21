<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Pages\Page;

// Requests
use DDD\Domain\Pages\Requests\PageNestingRequest;

// Resources
use DDD\Domain\Pages\Resources\PageResource;

class PageNestingController extends Controller
{
    public function update(Organization $organization, Page $page, PageNestingRequest $request)
    {
        // Update parent
        $page->update([
            'parent_id' => $request->parent_id,
        ]);

        // Update order
        $page->reorder($request->order);

        return response()->json([
            'message' => 'Page nesting successfully updated.',
            'data' => $page,
        ], 200);
    }
}
