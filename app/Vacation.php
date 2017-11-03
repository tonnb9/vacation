<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $fillable = [
        'from_date', 'to_date', 'user_id','approved'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
