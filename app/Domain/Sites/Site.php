<?php

namespace DDD\Domain\Sites;

// Traits
use DDD\App\Traits\BelongsToOrganization;

// Casts
use DDD\Domain\Sites\Casts\LaunchInfo;

// Database
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
