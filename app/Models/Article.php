<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'category_id',
        'content_id',
        'user_id',
        'title',
        'slug',
        'body',
        'featured_image',
        'author_name',
        'is_approved',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_approved' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            if (str_starts_with($this->featured_image, 'http://') || str_starts_with($this->featured_image, 'https://')) {
                return $this->featured_image;
            }
            if (file_exists(public_path('storage/articles/' . $this->featured_image))) {
                return asset('storage/articles/' . $this->featured_image);
            }
            if (file_exists(public_path('articles/' . $this->featured_image))) {
                return asset('articles/' . $this->featured_image);
            }
        }
        if ($this->content && $this->content->image) {
            return $this->content->image_url;
        }
        if ($this->category && $this->category->image) {
            return $this->category->image_url;
        }
        return asset('Main/assets/images/Cover.jpg');
    }

    public function getReadTimeAttribute(): string
    {
        $words = str_word_count(strip_tags($this->body));
        $minutes = ceil($words / 200);
        return ($minutes ?: 1) . ' min read';
    }
}
