<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\DeliveryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(
            Category::with('children')
                ->parents()
                ->ordered()
                ->get()
        );
    }

    public function menu(Request $request)
    {
        $menu = Category::where('slug', 'menu')->with([
            'children',
            'children.children',
            'children.children.children',
        ])
            ->ordered()
            ->get();

        return CategoryResource::collection($menu);
    }

    public function kitchen(Request $request)
    {
        $kitchen = Category::where('slug', 'kitchen')->with([
            'children',
            'children.children',
            'children.children.children',
        ])
            ->ordered()
            ->get();

        return CategoryResource::collection($kitchen);
    }

    public function bar(Request $request)
    {
        $bar = Category::where('slug', 'bar')->with([
            'children',
            'children.children',
            'children.children.children',
        ])
            ->ordered()
            ->get();

        return CategoryResource::collection($bar);
    }

    public function delivery(Request $request)
    {
        $delivery = Category::where('deliverable', true)->with([
            'delivery',
            'delivery.delivery',
            'delivery.delivery.delivery',
        ])
            ->ordered()
            ->get();

        return DeliveryResource::collection($delivery);
    }
}
