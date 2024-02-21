<?php

namespace DDD\Domain\Google;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DDD\App\Traits\BelongsToUser;

class GoogleCredentials extends Model
{
    use HasFactory,
        BelongsToUser;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'token' => 'json',
    ];
}
