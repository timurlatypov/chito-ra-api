<?php

namespace App\Models;

use App\Cart\Money;
use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasPrice;

    const PENDING    = 'создан';
    const DELIVERING = 'в работе';
    const DONE       = 'доставлен';
    const CANCELLED  = 'отменён';

    protected $fillable = [
        'status',
        'address_id',
        'shipping_method_id',
        'subtotal',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->status = self::PENDING;
        });
    }

    public function getSubtotalAttribute($subtotal)
    {
        return new Money($subtotal);
    }

    public function total()
    {
        return $this->subtotal->add($this->shippingMethod->price);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function products()
    {
        return $this->belongsToMany(ProductVariation::class, 'product_variation_order')
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    public function getStatusWithColorAttribute()
    {
        switch ($this->status) {
            case 'новый заказ':
                return "<div class='inline-block bg-green-600 text-white font-bold text-sm py-2 px-3 rounded-full'><i class='fas fa-star'></i> новый заказ</div>";
            case 'в работе':
                return "<div class='inline-block bg-yellow-500 text-white font-bold text-sm py-2 px-3 rounded-full'><i class='fas fa-shipping-fast'></i> в работе</div>";
            case 'доставлен':
                return "<div class='inline-block bg-blue-400 text-white font-bold text-sm py-2 px-3 rounded-full'><i class='fas fa-thumbs-up'></i> доставлен</div>";
            case 'отменен':
                return "<div class='inline-block bg-red-400 text-white font-bold text-sm py-2 px-3 rounded-full'><i class='fas fa-times'></i> отменен</div>";
            default:
                return $this->status;
        }
    }
}
