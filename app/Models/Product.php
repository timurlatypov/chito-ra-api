<?php

namespace App\Models;

use App\Traits\CanBeScoped;
use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use CanBeScoped, HasPrice;

	protected $fillable = [
		'name',
		'slug',
		'price',
		'description',
		'deliverable',
		'live',
		'spicy',
		'top',
	];

    public function getRouteKeyName()
    {
    	return 'slug';
    }

	public function categoriesArray()
	{
		return $this->categories()->pluck('category_id');
	}

    public function inStock()
    {
    	return $this->stockCount() > 0;
    }

    public function stockCount()
    {
    	return $this->variations->sum(function ($variation) {
    		return $variation->stockCount();
	    });
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function variations()
    {
    	return $this->hasMany(ProductVariation::class)->orderBy('order', 'asc');
    }

    public function images()
    {
    	return $this->belongsToMany(Image::class,'product_images', 'product_id', 'image_id');
    }
}
