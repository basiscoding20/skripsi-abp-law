<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['format_date'];

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userRole()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'user');
    }
    

    public function getFormatDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
