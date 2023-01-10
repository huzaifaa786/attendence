<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leagues extends Model
{
    protected $fillable=[
        'title','price','player_limit','prize','rules','image','game_id','date'
       ];
       protected $with = ['game'];
       protected $hidden=['created_at','updated_at'];
   
       public function getImageAttribute($value){
           return asset($value);
       }
   
       public function game(){
           return $this->belongsTo(Game::class);
       }
   
       public function setImageAttribute($value){
           if(is_string($value)){
               $this->attributes['image'] = ImageHelper::saveImageFromApi($value,'images/league');
           }
           else if(is_file($value)){
               $this->attributes['image'] = ImageHelper::saveResizedImage($value,'images/league',650,700);
           }
       }
}
