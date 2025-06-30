<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'slug',
        'position',
        'description',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
