<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait isLive
{
	public function scopeLive(Builder $builder)
	{
		return $builder->where('live', true);
	}

	public function isLive()
	{
		return $this->live === 1;
	}

	public function isNotLive()
	{
		return !$this->isLive();
	}
}