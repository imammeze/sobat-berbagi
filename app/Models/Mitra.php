<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mitra extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'logo',
        'description',
        'address',
        'phone',
        'pic_name',
        'identity_number',
        'identity_file',
        'identity_file_handheld',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function donations()
    {
        return $this->hasMany(CampaignDonation::class);
    }


    public function getLogoAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = $value->store('assets/mitra/logo', 'public');
    }

    public function getIdentityFileAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setIdentityFileAttribute($value)
    {
        $this->attributes['identity_file'] = $value->store('assets/mitra/identity_file', 'public');
    }

    public function getIdentityFileHandheldAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setIdentityFileHandheldAttribute($value)
    {
        $this->attributes['identity_file_handheld'] = $value->store('assets/mitra/identity_file_handheld', 'public');
    }
}
