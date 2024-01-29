<?php

namespace DDD\Domain\Pages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\App\Traits\HasSlug;

class PageJunkStatus extends Model
{
    use HasFactory,
        HasSlug;

    protected $guarded = [
        'id',
    ];
}
