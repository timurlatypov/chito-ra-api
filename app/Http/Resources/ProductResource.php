<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductVariationResource;
use Illuminate\Http\Request;

class ProductResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            [
                'variations' => ProductVariationResource::collection(
                    $this->variations->groupBy('type.name')
                ),
                'images'     => ImageResource::collection(
                    $this->images
                ),
                'categories' => $this->categoriesArray(),
            ]);
    }
}
