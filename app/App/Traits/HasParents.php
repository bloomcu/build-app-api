<?php

namespace DDD\App\Traits;

// Vendors
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasParents
{
    use HasRecursiveRelationships;

    /**
     * Get the nested children associated with this model.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order');
    }

    /**
     * Get only parents (top level models).
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
