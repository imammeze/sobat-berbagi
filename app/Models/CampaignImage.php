<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignImage extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'campaign_id',
        'image',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value->store('assets/campaigns/images', 'public');
    }
}
