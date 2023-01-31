<?php

namespace DDD\Domain\Base\Organizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Vendors
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// Traits
use DDD\App\Traits\HasComments;
use DDD\App\Traits\HasSlug;

class Organization extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasComments,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Users associated with the organization.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany('DDD\Domain\Base\Users\User');
    }

    /**
     * Invitations associated with the organization.
     *
     * @return hasMany
     */
    public function invitations()
    {
        return $this->hasMany('DDD\Domain\Base\Invitations\Invitation');
    }

    /**
     * Teams that belong to this team.
     *
     * @return hasMany
     */
    public function teams()
    {
        return $this->hasMany('DDD\Domain\Base\Teams\Team');
    }

    /**
     * Sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites()
    {
        return $this->hasMany('DDD\Domain\Base\Sites\Site');
    }

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

    /**
     * Designs associated with this organization.
     *
     * @return hasMany
     */
    public function designs()
    {
        return $this->hasMany('DDD\Domain\Designs\Design');
    }
}
