<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
    	'name',
	    'alt'
    ];

    public function product()
    {
    	return $this->belongsToMany(Product::class, 'product_images', 'image_id', 'product_id');
    }

	public function category()
	{
		return $this->belongsToMany(Category::class, 'category_images', 'image_id', 'category_id');
	}

    public function default()
    {
    	return $this->where('default', true)->first();
    }
}
