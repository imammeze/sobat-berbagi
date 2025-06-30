<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Campaign extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'campaign_category_id',
        'mitra_id',
        'title',
        'slug',
        'thumbnail',
        'story',
        'target',
        'raised',
        'end_date',
        'status',
        'type',
        'is_fixed_amount',
        'fixed_amount',
        'is_featured',
    ];
    

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function campaignCategory()
    {
        return $this->belongsTo(CampaignCategory::class);
    }

    public function images()
    {
        return $this->hasMany(CampaignImage::class);
    }

    public function setThumbnailAttribute($value)
    {
        $this->attributes['thumbnail'] = $value->store('assets/campaign/thumbnail', 'public');
    }

    public function getThumbnailAttribute($value)
    {
        return asset('storage/' . $value);
    }


    public function donations()
    {
        return $this->hasMany(CampaignDonation::class);
    }

    public function latestNews()
    {
        return $this->hasMany(CampaignLatestNews::class);
    }

    public function getTotalDonatur()
    {
        return $this->donations()->count();
    }

    public function getFormattedTargetAttribute()
    {
        return "Rp. " . number_format($this->target, 0, ',', '.');
    }

    public function getFormattedRaisedAttribute()
    {
        return "Rp. " . number_format($this->raised, 0, ',', '.');
    }

    public function scopeCampaign($query)
    {
        return $query->where('type', 'campaign');
    }

    public function scopeEvent($query)
    {
        return $query->where('type', 'event');
    }

    public function getFormattedFixedAmountAttribute()
    {
        return $this->fixed_amount ? "Rp. " . number_format($this->fixed_amount, 0, ',', '.') : '-';
    }

}
