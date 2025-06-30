<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class FaqCategory extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
