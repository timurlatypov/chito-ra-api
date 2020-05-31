<?php

namespace App\Http\Controllers\Cart;

use App\Cart\Cart;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Requests\Cart\CartUpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\ProductVariation;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    protected $cart;

    protected function meta(Cart $cart, Request $request, ShippingMethod $shipping)
    {
        return [
            'empty'    => $cart->isEmpty(),
            'subtotal' => $cart->subtotal()->formatted(),
            'total'    => $cart->withShipping($request->shipping_method ? : $shipping->defaultId())->total()->formatted(),
            'changed'  => $cart->hasChanged(),
        ];
    }

    /**
     * CartController constructor.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->middleware(['auth:api']);
        $this->cart = $cart;
    }

    /**
     * @param Request        $request
     * @param Cart           $cart
     * @param ShippingMethod $shipping
     *
     * @return CartResource
     */
    public function index(Request $request, Cart $cart, ShippingMethod $shipping)
    {
        $cart->sync();

        $request->user()->load([
            'cart.product',
            'cart.product.images',
            'cart.product.variations.stock',
            'cart.stock',
        ]);

        return (new CartResource($request->user()))
            ->additional([
                'meta' => $this->meta($cart, $request, $shipping),
            ]);
    }

    /**
     * @param CartStoreRequest $request
     * @param User             $user
     */
    public function store(CartStoreRequest $request, User $user)
    {
        $this->cart->add($request->products);
    }

    /**
     * @param ProductVariation  $productVariation
     * @param CartUpdateRequest $request
     * @param Cart              $cart
     */
    public function update(ProductVariation $productVariation, CartUpdateRequest $request, Cart $cart)
    {
        $cart->update($productVariation->id, $request->quantity);
    }

    /**
     * @param ProductVariation $productVariation
     * @param Cart             $cart
     */
    public function destroy(ProductVariation $productVariation, Cart $cart)
    {
        $cart->delete($productVariation->id);
    }
}
