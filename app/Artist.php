<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public $timestamps = false;

    public function albums()
    {
        return $this->hasMany('App\Album');
    }
}
