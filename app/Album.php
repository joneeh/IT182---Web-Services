<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'artist_id',
        'title',
        'genre',
        'description',
    ];
    
    public $timestamps = false;

    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }

    public function tracks()
    {
        return $this->hasMany('App\Track');
    }
}
