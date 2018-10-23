<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{   
    const ADMIN = 1;
    use Notifiable;

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

    protected  $ADMIN = "Admin";

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function isAdmin(){
        // dd($this->role()->id);
        return $this->role->title === $this->ADMIN;
    }
    
}
