<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialAccount extends Model
{
    protected $fillable = [
        'user_id',
        'provider_id',
        'provider_name',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
