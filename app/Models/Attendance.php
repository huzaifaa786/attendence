<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'fingerprint_id',
        'lecture_id'
    ];

    public function lecture() : BelongsTo
    {
        return $this->belongsTo(Lecture::class,'lecture_id');
    }
    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    } 
}
