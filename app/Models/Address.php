<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
    	'name',
	    'address',
	    'comment',
	    'default'
    ];

	public static function boot()
	{
		parent::boot();

		static::creating(function ($address) {
			if ($address->default) {
				$address->user->addresses()->update([
					'default' => false
				]);
			}
		});
	}

	public function setDefaultAttribute($value)
	{
		$this->attributes['default'] = ($value === 'true' || $value ? true : false);
	}

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
