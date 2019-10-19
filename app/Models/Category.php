<?php

namespace App\Models;

use App\Traits\HasChildren;
use App\Traits\IsOrderable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasChildren, IsOrderable;

    protected $fillable = [
    	'name',
	    'slug',
	    'parent_id',
	    'order'
    ];

    public function children()
    {
    	return $this->hasMany(Category::class,'parent_id', 'id');
    }

    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('order')->orderBy('category_product.order', 'asc');
    }

	public function image()
	{
		return $this->belongsToMany(Image::class,'category_images', 'category_id', 'image_id');
	}

	public function sketch()
	{
		return $this->belongsToMany(Image::class,'category_sketches', 'category_id', 'image_id');
	}
}
