<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CampaignCategory extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
