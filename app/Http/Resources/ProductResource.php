<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductIndexResource;

class ProductResource extends ProductIndexResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'variations' => []
        ]);
    }
}
