<?php

namespace App\Cart;

use App\Models\ShippingMethod;

class Cart
{
    protected $user;
    protected $changed = false;
    protected $shipping;

    /**
     * Cart constructor.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function products()
    {
        return $this->user->cart;
    }

    /**
     * @param $shippingId
     *
     * @return $this
     */
    public function withShipping($shippingId)
    {
        $this->shipping = ShippingMethod::find($shippingId);

        return $this;
    }

    /**
     * @param $products
     */
    public function add($products)
    {
        $this->user->cart()->syncWithoutDetaching(
            $this->getStorePayload($products)
        );
    }

    /**
     * @param $productId
     * @param $quantity
     */
    public function update($productId, $quantity)
    {
        $this->user->cart()->updateExistingPivot($productId, [
            'quantity' => $quantity,
        ]);
    }

    /**
     * @param $productId
     */
    public function delete($productId)
    {
        $this->user->cart()->detach($productId);
    }

    /**
     *
     */
    public function empty()
    {
        $this->user->cart()->detach();
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->user->cart->sum('pivot.quantity') <= 0;
    }

    /**
     * @return Money
     */
    public function subtotal()
    {
        $subtotal = $this->user->cart->sum(function ($product) {
            return $product->price->amount() * $product->pivot->quantity;
        });

        return new Money($subtotal);
    }

    /**
     * @return Money
     */
    public function total()
    {
        if ($this->shipping) {
            return $this->subtotal()->add($this->shipping->price);
        }

        return $this->subtotal();
    }

    /**
     *
     */
    public function sync()
    {
        $this->user->cart->each(function ($product) {
            $quantity = $product->minStock($product->pivot->quantity);

            if ($quantity != $product->pivot->quantity) {
                $this->changed = true;
            }

            $product->pivot->update([
                'quantity' => $quantity,
            ]);
        });
    }

    /**
     * @return bool
     */
    public function hasChanged()
    {
        return $this->changed;
    }

    /**
     * @param $products
     *
     * @return array
     */
    protected function getStorePayload($products)
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id']),
            ];
        })->toArray();
    }

    /**
     * @param $productId
     *
     * @return int
     */
    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->user->cart->where('id', $productId)->first()) {
            return $product->pivot->quantity;
        }

        return 0;
    }
}
