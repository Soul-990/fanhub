<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// Backwards compatibility alias for lowercase classname
if (!class_exists('App\Models\feedback', false)) {
    class_alias(Feedback::class, 'App\Models\feedback');
}
