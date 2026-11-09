<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'content_id',
        'title',
        'type',
        'file_url',
        'thumbnail',
        'description',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            if (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://')) {
                return $this->thumbnail;
            }
            if (file_exists(public_path('storage/media/' . $this->thumbnail))) {
                return asset('storage/media/' . $this->thumbnail);
            }
        }
        if ($this->file_url && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $this->file_url, $matches)) {
            return 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
        }
        if ($this->content && $this->content->image) {
            return $this->content->image_url;
        }
        return asset('Main/assets/images/Cover.jpg');
    }
}
