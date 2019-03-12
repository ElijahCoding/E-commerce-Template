<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\{HasChildren, IsOrderable};

class Category extends Model
{
    use HasChildren, IsOrderable;

    protected $fillable = [
        'name', 'order', 'slug'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
