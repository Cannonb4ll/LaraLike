<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'ip',
        'hostname',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
