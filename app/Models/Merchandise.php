<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $table = 'merchandise';

    protected $fillable = [
        'content_id',
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'product_url',
        'tag',
        'is_upcoming',
    ];

    protected $casts = [
        'is_upcoming' => 'boolean',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            if (file_exists(public_path('storage/merchandise/' . $this->image))) {
                return asset('storage/merchandise/' . $this->image);
            }
            if (file_exists(public_path('merchandise/' . $this->image))) {
                return asset('merchandise/' . $this->image);
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
}
