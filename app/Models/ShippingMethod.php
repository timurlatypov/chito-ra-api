<?php

namespace App\Models;

use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasPrice;

	public function defaultId()
	{
		return $this->where('default', true)->first()->id;
	}
}
