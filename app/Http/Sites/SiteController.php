<?php

namespace DDD\Http\Sites;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Sites\Site;

// Services
use DDD\App\Services\UrlService;

// Requests
use DDD\Domain\Sites\Requests\SiteStoreRequest;

// Resources
use DDD\Domain\Sites\Resources\SiteResource;

class SiteController extends Controller
{
    public function index(Organization $organization)
    {
        $sites = $organization->sites;

        return SiteResource::collection($sites);
    }

    public function store(Organization $organization, SiteStoreRequest $request)
    {
        $site = $organization->sites()->create([
            'title' => $request->title,
            'url' => $request->url,
            'host' => UrlService::getHost($request->url),
            'scheme' => UrlService::getScheme($request->url),
        ]);

        return new SiteResource($site);
    }

    public function show(Organization $organization, Site $site)
    {
        return new SiteResource($site);
    }

    public function destroy(Organization $organization, Site $site)
    {
        $site->delete();

        return new SiteResource($site);
    }
}
