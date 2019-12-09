<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'album_id',
        'title',
        'duration',
    ];

    public $timestamps = false;

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
}
