<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Validate{

    public static function login($request, $model){

        $validator = Validator::make($request->all(),$model::loginRules());
        
        if($validator->fails()){
            toastr()->error($validator->errors()->first());
            
            if(Request::is('/vendor')){
                Redirect::to(route('front.vendor.login'))->withInput()->send();

            }else{
                Redirect::to(route('user.login'))->withInput()->send();

            }
        }
        else
            return[
                'email' => $request->email,
                'password' => $request->password
            ];
    }
    
    public static function register($request, $model){
        $validator = Validator::make($request->all(),$model::registerRules());
        
        if($validator->fails()){
            toastr()->error($validator->errors()->first());
             Redirect::to(route('admin.user.create'))->withInput()->send();
           
        }
        else{
            $data = [ 'api_token' => Str::random(60) ] + $request->all();
            return $data;
        }
          
    }
    
    public static function teacher_register($request, $model){
        $validator = Validator::make($request->all(),$model::teacherRules());
        
        if($validator->fails()){
            toastr()->error($validator->errors()->first());
             Redirect::to(route('admin.teacher.create'))->withInput()->send();
           
        }
        else{
            $data = [ 'api_token' => Str::random(60) ] + $request->all();
            return $data;
        }
          
    }



}