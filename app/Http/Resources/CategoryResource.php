<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
	        'slug' => $this->slug,
	        'children' => CategoryResource::collection($this->whenLoaded('children')),
	        'products' => ProductResource::collection($this->products),
	        'image' => CategoryImageResource::collection($this->image),
	        'sketch' => CategorySketchResource::collection($this->sketch),
        ];
    }
}
