<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Content extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'type',
        'release_date',
        'release_year',
        'views',
        'popularity',
        'image',
        'status',
    ];

    /**
     * Aliases for title <-> name
     */
    public function getTitleAttribute(): string
    {
        return $this->attributes['name'] ?? '';
    }

    public function setTitleAttribute($value): void
    {
        $this->attributes['name'] = $value;
    }

    /**
     * Aliases for cover_image <-> image
     */
    public function getCoverImageAttribute(): string
    {
        return $this->attributes['image'] ?? '';
    }

    public function setCoverImageAttribute($value): void
    {
        $this->attributes['image'] = $value;
    }

    public function getImageUrlAttribute(): string
    {
        $img = $this->image ?? $this->cover_image ?? null;
        if (!$img) {
            return asset('Main/assets/images/Cover.jpg');
        }
        if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
            return $img;
        }
        if (file_exists(public_path('content/' . $img))) {
            return asset('content/' . $img);
        }
        if (file_exists(public_path('Content/' . $img))) {
            return asset('Content/' . $img);
        }
        if (file_exists(public_path('Cat/' . $img))) {
            return asset('Cat/' . $img);
        }
        return asset('Main/assets/images/Cover.jpg');
    }

    public function getYearAttribute(): string
    {
        if (!empty($this->release_year)) {
            return (string)$this->release_year;
        }
        if (!empty($this->release_date)) {
            return date('Y', strtotime($this->release_date));
        }
        return 'N/A';
    }

    public function getAverageRatingAttribute(): ?float
    {
        $avg = $this->ratings()->avg('rating');
        return $avg ? round((float)$avg, 1) : null;
    }

    public function getFormattedRatingAttribute(): string
    {
        $avg = $this->average_rating;
        return $avg !== null ? number_format($avg, 1) : 'N/A';
    }

    public function getRatingCountAttribute(): int
    {
        return $this->ratings()->count();
    }

    public function isBookmarkedBy($userId): bool
    {
        if (!$userId) return false;
        return $this->bookmarks()->where('user_id', $userId)->exists();
    }

    public function userRating($userId)
    {
        if (!$userId) return null;
        return $this->ratings()->where('user_id', $userId)->first();
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'content_genre');
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function merchandise()
    {
        return $this->hasMany(Merchandise::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}

if (!class_exists('App\Models\content', false)) {
    class_alias(Content::class, 'App\Models\content');
}

