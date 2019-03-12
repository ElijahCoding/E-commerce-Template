<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductVariationResource;

class ProductResource extends ProductIndexResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'variations' => ProductVariationResource::collection(
                $this->variations->groupBy('type.name')
            )
        ]);
    }
}
