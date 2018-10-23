<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genure extends Model
{
    //
    protected $fillable = ['name'];

    public function songs()
    {
        return $this->hasMany('App\Song');
    }
}
