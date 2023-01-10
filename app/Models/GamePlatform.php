<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePlatform extends Model
{
    use HasFactory;
    protected $fillable = [
        'game_id','platform_id'
    ];
    protected $hidden=['created_at','updated_at'];

    protected $with = ['platform'];
    public function platform(){
        return $this->belongsTo(Platform::class);
    }
}
