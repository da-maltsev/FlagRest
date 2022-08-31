<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function artists()
    {
        return $this->belongsToMany('App\Models\Artist');
    }
}
