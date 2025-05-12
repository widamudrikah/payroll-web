<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attandance extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
