<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, UUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        if (Auth::user()->hasRole('donatur')) {
            return $this->hasOne(Donatur::class);
        } elseif (Auth::user()->hasRole('mitra')) {
            return $this->hasOne(Mitra::class);
        }
    }

    public function donaturRelation()
    {
        return $this->hasOne(Donatur::class);
    }

    public function mitraRelation()
    {
        return $this->hasOne(Mitra::class);
    }

    public function donations()
    {
        return $this->hasMany(CampaignDonation::class);
    }

    public function zakats()
    {
        return $this->hasMany(ZakatTransaction::class);
    }

    public function webNotifications()
    {
        return $this->hasMany(WebNotification::class);
    }
}
