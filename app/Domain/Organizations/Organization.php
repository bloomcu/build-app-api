<?php

namespace DDD\Domain\Organizations;

// Domains
use DDD\Domain\Base\Organizations\Organization as BaseOrganization;

class Organization extends BaseOrganization {
    /**
     * Crawls associated with the organization.
     *
     * @return hasMany
     */
    public function crawls()
    {
        return $this->hasMany('DDD\Domain\Crawls\Crawl');
    }

    /**
     * Last crawl associated with the organization.
     *
     * @return model
     */
    public function lastCrawl()
    {
        return $this->hasOne('DDD\Domain\Crawls\Crawl')->latest();
    }

    /**
     * Designs associated with this organization.
     *
     * @return hasMany
     */
    public function designs()
    {
        return $this->hasMany('DDD\Domain\Designs\Design');
    }

    /**
     * Sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites()
    {
        return $this->hasMany('DDD\Domain\Sites\Site');
    }

    /**
     * Pages associated with the organization.
     *
     * @return hasMany
     */
    public function pages()
    {
        return $this->hasMany('DDD\Domain\Pages\Page');
    }

    /**
     * Redirects associated with the organization.
     *
     * @return hasMany
     */
    public function redirects()
    {
        return $this->hasMany('DDD\Domain\Redirects\Redirect');
    }
}
