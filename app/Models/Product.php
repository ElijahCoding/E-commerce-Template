<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\{CanBeScoped, HasPrice};

class Product extends Model
{
    use CanBeScoped, HasPrice;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('order', 'asc');
    }
}
