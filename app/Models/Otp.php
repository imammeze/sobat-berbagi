<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'otp',
        'expired_at',
        'user_id',
    ];

    protected $dates = [
        'expired_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeValid($query)
    {
        return $query->where('expired_at', '>=', now());
    }

    public function scopeInvalid($query)
    {
        return $query->where('expired_at', '<', now());
    }
}
