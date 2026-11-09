<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'characters';

    protected $fillable = [
        'category_id',
        'content_id',
        'name',
        'role',
        'desc',
        'bio',
        'image',
        'views',
    ];

    public function getDescriptionAttribute(): string
    {
        return $this->attributes['desc'] ?? '';
    }

    public function setDescriptionAttribute($value): void
    {
        $this->attributes['desc'] = $value;
    }

    public function getImageUrlAttribute(): string
    {
        $img = $this->image;
        if (!$img) {
            return asset('Main/assets/images/Cover.jpg');
        }
        if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
            return $img;
        }
        if (file_exists(public_path('character/' . $img))) {
            return asset('character/' . $img);
        }
        if (file_exists(public_path('Character/' . $img))) {
            return asset('Character/' . $img);
        }
        if (file_exists(public_path('Cat/' . $img))) {
            return asset('Cat/' . $img);
        }
        if (file_exists(public_path('content/' . $img))) {
            return asset('content/' . $img);
        }
        return asset('Main/assets/images/Cover.jpg');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}

if (!class_exists('App\Models\characters', false)) {
    class_alias(Character::class, 'App\Models\characters');
}
