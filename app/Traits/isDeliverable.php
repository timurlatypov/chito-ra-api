<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait isDeliverable
{
    public function scopeDeliverable(Builder $builder)
    {
        return $builder->where('deliverable', true);
    }

    public function isDeliverable()
    {
        return $this->deliverable === 1;
    }

    public function isNotDeliverable()
    {
        return !$this->isDeliverable();
    }
}
