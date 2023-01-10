<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable= [
        'subject','message','user_id','last_seen'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function replies(){
        return $this->hasMany(TicketReply::class);
    }

    public function getLastSeenAttribute($value)
    {
        return Carbon::parse($value)->format('g:i A');;
    } 

    
}
