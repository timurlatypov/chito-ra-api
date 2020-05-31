<?php

namespace App\Http\Controllers\Products;

use App\Http\Requests\Products\ProductPatchRequest;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Scoping\Scopes\CategoryScope;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\ResponseCache\Facades\ResponseCache;

class ProductController extends Controller
{
	private $image;

	public function __construct (Image $image)
	{
		$this->image = $image;
	}

	public function index ()
	{
		$products = Product::with(['variations.stock'])->withScopes($this->scopes())->paginate(200);

		return ProductResource::collection($products);
	}


	public function edit (Product $product)
	{
		$product->load(['variations.type', 'variations.stock', 'variations.product']);

		return new ProductResource(
			$product
		);
	}

	public function store (ProductStoreRequest $request)
	{
		$product = Product::create([
			'name' => $request->name,
			'slug' => $request->slug,
			'description' => $request->description,
			'deliverable' => $request->deliverable,
			'live' => $request->live,
			'spicy' => $request->spicy,
			'top' => $request->top
		]);

		$variation = ProductVariation::create([
			'product_id' => $product->id,
			'name' => $request->volume,
			'price' => $request->price,
			'product_variation_type_id' => 1
		]);

		$product->images()->attach($this->image->default());

		return response()->json($product, 200);
	}

	public function update (ProductPatchRequest $request)
	{
		$product = Product::find($request->id);

		$product->update([
			'name' => $request->name,
			'slug' => $request->slug,
			'description' => $request->description,
		]);
		return response()->json($product, 200);
	}

	public function productCategories (Product $product, Request $request)
	{
		$product->categories()->sync($request->categories);

		return new ProductResource(
			$product
		);
	}

	public function toggleField (Product $product, $field, Request $request)
	{
		$product->update([
			$field => $request->toggle
		]);
		return $product;
	}

	protected function scopes ()
	{
		return [
			'category' => new CategoryScope()
		];
	}
}
