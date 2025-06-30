<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignDonation extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'campaign_id',
        'user_id',
        'payment_method_id',
        'proof',
        'qr_code',
        'invoice_id',
        'is_anonymous',
        'amount',
        'status',
        'message',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }


    public function getProofAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setProofAttribute($value)
    {
        if ($value) {
            $this->attributes['proof'] = $value->store('assets/donation-proof', 'public');
        }
    }
}
