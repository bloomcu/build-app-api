<?php

namespace DDD\Domain\Sites;

use DDD\App\Traits\BelongsToOrganization;
use DDD\Domain\Base\Sites\Casts\LaunchInfo;
// Casts
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Traits
use Illuminate\Database\Eloquent\Model;

// Casts
use DDD\Domain\Sites\Casts\LaunchInfo;

// Traits
use DDD\App\Traits\BelongsToOrganization;

class Site extends Model
{
    use BelongsToOrganization,
        // SoftDeletes,
        HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'launch_info' => LaunchInfo::class,
    ];
}
