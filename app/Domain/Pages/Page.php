<?php

namespace DDD\Domain\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

// Domains
use DDD\Domain\Base\Sites\Site;

// Traits
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\HasParents;
use DDD\App\Traits\IsCategorizable;
use DDD\App\Traits\IsSortable;
use DDD\App\Traits\IsStatusable;
use DDD\App\Traits\IsTaggable;

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

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
