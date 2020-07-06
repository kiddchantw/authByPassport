<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


// // use Illuminate\Contracts\Auth\Authenticatable;
// // use Illuminate\Auth\Authenticatable as AuthenticableTrait;
// // use Illuminate\Contracts\Auth\Authenticatable as AuthContract;

// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable  
{
    // use AuthenticableTrait;
    // use Notifiable,SoftDeletes;

    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Eloquent: Mutators
    public function setPasswordAttribute($password)
    {
        if ( $password !== null & $password !== "" )
        {
            //m1 ok
            //$this->attributes['password'] = bcrypt($password);
            
            //m2 use Illuminate\Support\Facades\Crypt;
            //$this->attributes['password'] = Crypt::encryptString($password);

            //m3 用hash make 
            $this->attributes['password'] = Hash::make($password);


        }
    }
}
