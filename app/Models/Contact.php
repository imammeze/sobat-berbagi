<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'company',
        'phone',
        'message',
    ];
}
