<?php

namespace App\Http\Controllers\Admin\Images;

use App\Http\Requests\Images\ImageStoreRequest;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(ImageStoreRequest $request)
    {
	    $storeFile = $request->file('file')->store('images', 'public');

	    if ($storeFile) {
	    	$image = Image::create([
	    		'name' => $storeFile
		    ]);

	    	$product = Product::where('slug', $request->product)->first();

	    	$product->images()->sync($image->id);

		    return response()->json([
			    'data' => [
			    	'id' => $image->id,
				    'name' => $image->name
			    ]
		    ], 200);
	    }

	    return response()->json([
		    'error' => 'Could not save file'
	    ], 405);
    }

    public function destroy($id)
    {
    	//
    }
}
