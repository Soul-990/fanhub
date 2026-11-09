<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'location',
        'city',
        'event_date',
        'image',
        'event_url',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

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
            if (file_exists(public_path('storage/events/' . $this->image))) {
                return asset('storage/events/' . $this->image);
            }
            if (file_exists(public_path('events/' . $this->image))) {
                return asset('events/' . $this->image);
            }
        }
        if ($this->category && $this->category->image) {
            return $this->category->image_url;
        }
        return asset('Main/assets/images/Cover.jpg');
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->event_date ? $this->event_date->format('M d, Y') : '';
    }

    public function getMonthNameAttribute(): string
    {
        return $this->event_date ? strtoupper($this->event_date->format('M')) : '';
    }

    public function getDayNumberAttribute(): string
    {
        return $this->event_date ? $this->event_date->format('d') : '';
    }
}
