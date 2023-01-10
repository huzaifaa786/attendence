<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'admin_read',
        'opponent_read',
        'to',
        'ticket_id',
        'admin_id',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('g:i A');;
    } 
}
