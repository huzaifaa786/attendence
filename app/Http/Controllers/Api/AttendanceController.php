<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function get()
    {
        $user = Auth::user();
        $attendances = Attendance::where('fingerprint_id',$user->fingerprint_id)->get();
        foreach($attendances as $attn){
            $attn->subject_name =  $attn->lecture->subject->name;
        }
        return Api::setResponse('attendances',$attendances);

    }
}
