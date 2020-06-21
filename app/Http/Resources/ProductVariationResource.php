<?php

namespace App\Http\Resources;

use App\Models\ProductVariationType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ProductVariationResource extends JsonResource
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

        if ($this->resource instanceof Collection) {
            return ProductVariationResource::collection($this->resource)->jsonSerialize();
        }

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'vol'          => $this->vol,
            'price'        => $this->formattedPrice,
            'min_order'    => $this->min_order,
            'max_order'    => $this->max_order,
            'price_varies' => $this->priceVaries(),
            'stock_count'  => (int)$this->stockCount(),
            'type'         => $this->type->name,
            'measure_type' => $this->measure->type,
            'in_stock'     => $this->inStock(),
            'product'      => (new ProductIndexResource($this->product))->jsonSerialize(),
        ];
    }
}
