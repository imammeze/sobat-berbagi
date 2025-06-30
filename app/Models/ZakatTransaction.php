<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZakatTransaction extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'category_zakat',
        'user_id',
        'payment_method_id',
        'proof',
        'qr_code',
        'invoice_id',
        'is_anonymous',
        'amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function getFormattedAmountAttribute()
    {
        return 'Rp. ' . number_format($this->amount, 0, ',', '.');
    }

    public function getProofAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setProofAttribute($value)
    {
        if ($value) {
            $this->attributes['proof'] = $value->store('assets/zakat-proof', 'public');
        }
    }
}
