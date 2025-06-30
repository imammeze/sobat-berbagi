<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignLatestNews extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'campaign_id',
        'date',
        'title',
        'content',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function getFormattedDateAttribute()
    {
        return date('d F Y', strtotime($this->date));
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }

    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }
}
