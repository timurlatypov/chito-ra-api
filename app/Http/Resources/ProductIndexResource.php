<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        	'id' => $this->id,
        	'name' => $this->name,
        	'description' => $this->description,
        	'slug' => $this->slug,
        	'live' => (bool) $this->live,
        	'deliverable' => (bool) $this->deliverable,
        	'spicy' => (bool) $this->spicy,
        	'top' => (bool) $this->top,
	        'price' => $this->formattedPrice,
	        'in_stock' => $this->inStock(),
            'images' => $this->images,
        ];
    }
}
