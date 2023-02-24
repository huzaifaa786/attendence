<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id', 'name','teacher_id'
    ];

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    } 
    public function content(){
        return $this->hasMany(Content::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
}
