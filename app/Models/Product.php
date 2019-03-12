<?php

namespace App\Models;

use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeWithScopes(Builder $builder)
    {
        return new Scoper();
    }
}
