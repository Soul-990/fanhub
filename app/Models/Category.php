<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function merchandise()
    {
        return $this->hasMany(Merchandise::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('Main/assets/images/Cover.jpg');
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        if (file_exists(public_path('Cat/' . $this->image))) {
            return asset('Cat/' . $this->image);
        }
        if (file_exists(public_path('cat/' . $this->image))) {
            return asset('cat/' . $this->image);
        }
        if (file_exists(public_path('content/' . $this->image))) {
            return asset('content/' . $this->image);
        }
        return asset('Main/assets/images/Cover.jpg');
    }
}
