<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function action($id)
    {
        $order = Order::with([
            'user',
            'address',
            'shippingMethod',
            'products',
        ])->find($id);

        return view('admin.order.view', compact('order'));
    }
}
