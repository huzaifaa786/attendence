<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];
    protected $hidden=['created_at','updated_at'];
    protected $with = ['platforms'];

    public function platforms(){
        return $this->belongsToMany(Platform::class,'game_platforms');
    }
}
