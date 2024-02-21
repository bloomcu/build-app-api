<?php

namespace DDD\Domain\Pages;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Pages\PageType;
use DDD\Domain\Pages\PageJunkStatus;
use DDD\Domain\Base\Sites\Site;
use DDD\App\Traits\IsTaggable;
use DDD\App\Traits\IsStatusable;
use DDD\App\Traits\IsSortable;
use DDD\App\Traits\IsCategorizable;
use DDD\App\Traits\HasParents;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\BelongsToOrganization;

class Page extends Model
{
    use HasFactory,
        SoftDeletes,
        BelongsToOrganization,
        BelongsToUser,
        HasParents,
        IsCategorizable,
        IsSortable,
        IsStatusable,
        IsTaggable;

    protected $guarded = [
        'id',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function (Model $page) {
            if (request()->junk_status) {
                $page->junkStatus()->associate(
                    PageJunkStatus::firstWhere('slug', request()->junk_status)
                );
            }

            if (request()->type) {
                $page->type()->associate(
                    PageType::firstWhere('slug', request()->type)
                );
            }
        });
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function junkStatus()
    {
        return $this->belongsTo(PageJunkStatus::class);
    }

    public function type()
    {
        return $this->belongsTo(PageType::class);
    }
}
