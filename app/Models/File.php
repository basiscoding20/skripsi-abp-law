<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'file_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'file_id');
    }
}
