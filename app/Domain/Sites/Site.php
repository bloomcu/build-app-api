<?php

namespace DDD\Domain\Sites;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Casts
use DDD\Domain\Sites\Casts\LaunchInfo;

// Traits
use DDD\App\Traits\BelongsToOrganization;

class Site extends Model
{
    use HasFactory,
        // SoftDeletes,
        BelongsToOrganization;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'launch_info' => LaunchInfo::class,
    ];
}
