<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FanArt extends Model
{
    protected $table = 'fan_arts';

    public function user()
    {
        return $this->belongsTo(User::class);
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
        if (file_exists(public_path('FanArt/' . $img))) {
            return asset('FanArt/' . $img);
        }
        if (file_exists(public_path('Cat/' . $img))) {
            return asset('Cat/' . $img);
        }
        if (file_exists(public_path('content/' . $img))) {
            return asset('content/' . $img);
        }
        return asset('Main/assets/images/Cover.jpg');
    }
}
