<?php

namespace App\Http\Controllers\ShippingMethods;

use App\Http\Resources\ShippingMethodsResource;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function index(ShippingMethod $shipping)
    {
    	return ShippingMethodsResource::collection(
		    $shipping->orderBy('default', 'desc')->get()
	    );
    }
}
