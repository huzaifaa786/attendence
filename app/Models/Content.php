<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'title','subject_id','file'
    ];


    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    } 

    public function setFileAttribute($file)
    {
        $this->attributes['file'] =  FileHelper::save($file,'files/');
    }
     public function getFileAttribute($file)
    {
        return asset($file);
    }
}
