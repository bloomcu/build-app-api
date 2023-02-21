<?php

namespace DDD\Domain\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

// Vendors
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

// Domains
use DDD\Domain\Base\Sites\Site;

// Traits
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\HasParents;
use DDD\App\Traits\IsCategorizable;
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
        IsStatusable,
        IsTaggable,
        SortableTrait;

    protected $guarded = [
        'id',
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => false,
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
