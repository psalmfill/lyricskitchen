<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected  $ADMIN = "admin";

    public function role(){
        // dd($this->belongsTo('App\Role'));
        return $this->belongsTo('App\Role');
    }

    public function isAdmin(){
        // dd($this->role);
        return $this->role->title == $this->ADMIN;
    }
    
}
