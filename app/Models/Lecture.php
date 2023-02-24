<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'subject_id','room_id','timeslot_id',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    
    public function room(){
        return $this->belongsTo(Room::class,'room_id');
    }
    public function timeslot(){
        return $this->belongsTo(TimeSlot::class,'timeslot_id');
    }
}
