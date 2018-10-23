<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    //
    protected $fillable = ['title','artist_id','genure_id','album_id','slug','lyrics','tags','video_url','year'];
    public function artist()
    {

        return $this->belongsTo('App\Artist');

    }

    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function genure()
    {
        return $this->belongsTo('App\Genure');
    }
}
