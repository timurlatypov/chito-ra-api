<?php

namespace App\Observers;

use App\Models\ProductVariation;
use Spatie\ResponseCache\Facades\ResponseCache;

class ProductVariationObserver
{
    /**
     * Handle the ProductVariation "created" event.
     *
     * @param ProductVariation $productVariation
     *
     * @return void
     */
    public function created(ProductVariation $productVariation)
    {
        ResponseCache::clear();
    }

    /**
     * Handle the ProductVariation "updated" event.
     *
     * @param ProductVariation $productVariation
     *
     * @return void
     */
    public function updated(ProductVariation $productVariation)
    {
        ResponseCache::clear();
    }

    /**
     * Handle the ProductVariation "deleted" event.
     *
     * @param ProductVariation $productVariation
     *
     * @return void
     */
    public function deleted(ProductVariation $productVariation)
    {
        ResponseCache::clear();
    }

    /**
     * Handle the ProductVariation "restored" event.
     *
     * @param ProductVariation $productVariation
     *
     * @return void
     */
    public function restored(ProductVariation $productVariation)
    {
        ResponseCache::clear();
    }

    /**
     * Handle the ProductVariation "force deleted" event.
     *
     * @param ProductVariation $productVariation
     *
     * @return void
     */
    public function forceDeleted(ProductVariation $productVariation)
    {
        ResponseCache::clear();
    }
}
