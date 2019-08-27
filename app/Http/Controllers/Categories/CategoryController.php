<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
		return CategoryResource::collection(
			Category::with('children', 'children.children')->parents()->ordered()->get()
		);
    }

	public function menu(Request $request)
	{
		$scope = $request->query('scope') ?? 'menu';

		$menu = Category::where('slug', $scope)->with([
			'children',
			'children.children',
			'children.children.children'
		])
			->ordered()
			->get();

		return CategoryResource::collection($menu);
	}
}
