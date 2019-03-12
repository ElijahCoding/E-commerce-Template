<?php

namespace App\Models;

use Money\Money;
use Money\Currency;
use NumberFormatter;
use App\Models\Category;
use App\Models\ProductVariation;
use Money\Formatter\IntlMoneyFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\{CanBeScoped, HasPrice};

class Product extends Model
{
    use CanBeScoped;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPriceAttribute($value)
    {
        return new Money($value, new Currency('USD'));
    }

    public function getFormattedPriceAttribute()
    {

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
