<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function action()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->get();

        return view('admin.order.index', compact('orders'));
    }
}
