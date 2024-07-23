<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Vendors
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Pages\Page;

// Requests
use DDD\Domain\Pages\Requests\PageStoreRequest;
// use DDD\Domain\Pages\Requests\PageUpdateRequest;

// Resources
use DDD\Domain\Pages\Resources\PageResource;

class PageController extends Controller
{
    public function index(Organization $organization)
    {
        $pages = QueryBuilder::for(Page::class)
            ->where('organization_id', $organization->id)
            ->defaultSort('order')
            ->allowedFilters([
                AllowedFilter::trashed(),
                'type.slug',
                'junkStatus.slug',
                'status.slug',
            ])
            ->parents()
            ->with('children')
            ->latest()
            ->get();

        return PageResource::collection($pages);
    }

    public function store(Organization $organization, PageStoreRequest $request)
    {
        $page = $organization->pages()->create(
            $request->validated()
        );

        // return new PageResource($page->load(['status', 'category', 'user']));
        return new PageResource($page);
    }

    public function show(Organization $organization, Page $page)
    {
        return new PageResource($page->load(['status', 'category', 'user']));
    }

    public function update(Organization $organization, Request $request)
    {
        $pages = Page::whereIn('id', $request->ids)->get();

        foreach ($pages as $page) {
            $page->update($request->except('ids'));
        }

        return response()->json([
            'message' => 'Pages successfully updated.',
        ], 200);
    }

    public function destroy(Organization $organization, Request $request)
    {
        $pages = Page::whereIn('id', $request->ids);

        $pages->update(['parent_id' => null]);

        $pages->delete();

        return response()->json([
            'message' => 'Pages successfully deleted.',
        ], 200);
    }

    public function restore(Organization $organization, Request $request)
    {
        $pages = Page::whereIn('id', $request->ids);

        $pages->restore();

        return response()->json([
            'message' => 'Pages successfully restored.',
        ], 200);
    }
}
