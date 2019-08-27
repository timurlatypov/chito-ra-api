<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable, HasApiTokens;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public static function boot()
	{
		parent::boot();

		static::creating(function ($user) {
			$user->password = bcrypt($user->password);
		});
	}

	public function cart()
	{
		return $this->belongsToMany(ProductVariation::class, 'cart_user')
			->withPivot('quantity')
			->withTimestamps();
	}

	public function addresses()
	{
		return $this->hasMany(Address::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
