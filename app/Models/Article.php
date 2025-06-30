<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'news_category_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'is_published',
        'is_archived',
        'is_pinned',
        'views',
    ];

    public function getThumbnailAttribute()
    {
        return asset('storage/' . $this->attributes['thumbnail']);
    }

    public function setThumbnailAttribute($value)
    {
        $this->attributes['thumbnail'] = $value->store('assets/news', 'public');
    }

    public function tags()
    {
        return $this->belongsToMany(ArticleTag::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class);
    }
}
