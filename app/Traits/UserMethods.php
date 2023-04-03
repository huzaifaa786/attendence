<?php

namespace App\Traits;
use Illuminate\Support\Facades\Hash;

trait UserMethods
{

    public static function registerRules()
    {
        return [
            'fname' => 'max:255|string|required',
            'lname' => 'max:255|string|required',
            'email' => 'email|required|unique:users',
            'password' => 'min:6|required',
            'roll_no' => 'max:11|required',
            'course_id' => 'integer|required',
            'guardian_name' => 'required',
            'guardian_email' => 'required',
        ];
    }
    public static function teacherRules()
    {
        return [
            'fname' => 'max:255|string|required',
            'lname' => 'max:255|string|required',
            'email' => 'email|required|unique:users',
            'password' => 'min:6|required',
        ];
    }


    public static function loginRules()
    {
        return [
            'email' => 'email|required',
            'password' => 'required'
        ];
    }

    // public function setImageAttribute($value){
    //     if(is_file($value)){
    //         $this->attributes['image'] = ImageHelper::saveImage($value,'images/profile');
    //     } else if (!empty($value)){
    //         $this->attributes['image'] = $value;
    //     }
    // }

    // public function getImageAttribute($value){
    //     return asset($value);
    // }


    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function withToken()
    {
        return $this->makeVisible(['api_token']);
    }
}
