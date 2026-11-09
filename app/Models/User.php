<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_banned',
        'profile_pic',
        'profile_image',
        'favorite_fandoms',
        'categories_of_interest',
        'display_preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return (int)$this->role === 1;
    }

    public function hasBookmarked($contentId): bool
    {
        return $this->bookmarks()->where('content_id', $contentId)->exists();
    }

    public function getAvatarUrlAttribute(): string
    {
        $img = $this->avatar ?? $this->profile_image ?? $this->profile_pic;
        if ($img) {
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                return $img;
            }
            if (file_exists(public_path('avatars/' . $img))) {
                return asset('avatars/' . $img);
            }
            return asset('storage/avatars/' . $img);
        }
        return asset('Main/assets/images/Avatar.jpg');
    }

    public function fanArts()
    {
        return $this->hasMany(FanArt::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
