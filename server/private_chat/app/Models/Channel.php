<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    protected $fillable = ['channel_name', 'url'];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\Model\User');
    }
}
