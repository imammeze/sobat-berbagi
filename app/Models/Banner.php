<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, UUID, SoftDeletes;

    public $fillable = [
        'desktop_image',
        'mobile_image',
        'link',
    ];

    public function getDesktopImageAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function getMobileImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
