<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'logo',
        'number',
        'owner',
        'category',
    ];

    public function campaignDonations()
    {
        return $this->hasMany(CampaignDonation::class);
    }

    public function getLogoAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = $value->store('assets/payment-method', 'public');
    }

    public function getNumberAttribute($value)
    {
        return substr($value, 0, 4) . ' ' . substr($value, 4, 4) . ' ' . substr($value, 8, 4) . ' ' . substr($value, 12, 4);
    }
}
