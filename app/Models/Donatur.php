<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donatur extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'user_id',
        'avatar',
        'npwz',
        'name',
        'phone_number',
        'address',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getAvatarAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
