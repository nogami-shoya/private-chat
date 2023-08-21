<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['channel_id', 'user_name'];
    public $timestamps = false;

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
