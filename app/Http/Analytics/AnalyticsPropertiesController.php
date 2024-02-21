<?php

namespace DDD\Http\Analytics;

use Illuminate\Http\Request;
use DDD\Domain\Organizations\Organization;
use DDD\App\Controllers\Controller;

class AnalyticsPropertiesController extends Controller
{
    /**
     * List all analytics properties.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Organization $organization)
    {
        $properties = $organization->analyticsProperties()->latest()->get();

        return response()->json([
            'data' => $properties
        ], 200);
    }

    /**
     * Store an analytics property.
     *
     * @return \Illuminate\Http\Response
     */
    // public function store(Organization $organization, AnalyticsPropertyStoreRequest $request)
    public function store(Organization $organization, Request $request)
    {
        $property = $organization->analyticsProperties()->create(
            $request->valdidated()
        );

        return response()->json([
            'data' => $property
        ], 200);
    }
}
