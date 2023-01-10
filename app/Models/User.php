<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use App\Traits\UserMethods;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserMethods;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'roll_no',
        'email',
        'phone',
        'guardian_name',
        'guardian_email',
        'password',
        'image',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getImageAttribute($value){
        return asset($value);
    }


    public function setImageAttribute($value){
	    if(is_string($value)){
	        $this->attributes['image'] = ImageHelper::saveImageFromApi($value,'images/user');
	    }
	    else if(is_file($value)){
	        $this->attributes['image'] = ImageHelper::saveResizedImage($value,'images/user',650,700);
	    }
    }

}
