<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'faq_category_id',
        'question',
        'answer',
    ];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}
