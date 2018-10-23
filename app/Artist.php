<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Song;

class Artist extends Model
{
    //
    protected $fillable = ['name'];
    public function albums(){

        return $this->hasMany('App\Album');
    }

    public function songs(){
        return $this->hasMany('App\Song');
    }
}
