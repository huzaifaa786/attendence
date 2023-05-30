<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\DefaultMail;
use App\Models\Attendance;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FingerPrintController extends Controller
{
    public function index()
    {


        return view('admin.attendance.index');
    }
    public function addFingerprintId(Request $request)
    {
        $fingerid = $request->fingerid;


        if (!$fingerid) {
            return "Enter a Fingerprint ID!";
        } elseif (!is_numeric($fingerid)) {
            return "The Fingerprint ID must be a numeric value!";
        } elseif ($fingerid <= 0 || $fingerid >= 128) {
            return "The Fingerprint ID must be between 1 & 127!";
        }

        $existingFingerprintId = User::where('fingerprint_id', $fingerid)->exists();
        if ($existingFingerprintId) {
            return "This ID is already exist!";
        }

        // Add new fingerprint ID
        $user = User::find($fingerid);
        $user->fingerprint_id = $fingerid;
        $user->has_finger_id = 1;

        $user->update();

        return "The ID is ready to get a new Fingerprint";
    }

    public function getFingerId(Request $request)
    {
        if ($request->has('Get_Fingerid')) {
            if ($request->Get_Fingerid == 'get_id') {
                $check = User::where('has_finger_id', true)->where('enrolled', false)->first();

                if ($check) {
                    $string = 'add-id' . $check->fingerprint_id;
                    return $string;
                } else {
                    return 'Nothing';
                }
            } else {
                return 'Invalid request';
            }
        } else {
            return 'Missing parameters';
        }
    }

    public function handleFingerID(Request $request)
    {
        if ($request->has('confirm_id')) {
            $fingerID = $request->confirm_id;
            $user = User::where('fingerprint_id', $fingerID)->first();
            $user->update(['enrolled' => 1]);
            return "succcess";
        } else if ($request->has('FingerID')) {
            $fingerID = $request->FingerID;

            $user = User::where('fingerprint_id', $fingerID)->first();
            if ($user) {
                // An existed fingerprint has been detected for Login or Logout
                if ($user->enrolled) {

                    $current_day = now()->format('l');

                    $current_time = now()->format('H:i:s');
                    dd($current_time);

                    $lecture = DB::table('lectures')
                        ->join('time_slots', 'lectures.timeslot_id', '=', 'time_slots.id')
                        ->join('days', 'time_slots.day_id', '=', 'days.id')
                        ->where('days.name', $current_day)
                        ->whereTime('time_slots.start_time', '<=', $current_time)
                        ->whereTime('time_slots.end_time', '>=', $current_time)
                        ->select('lectures.*')
                        ->first();
                    if ($lecture) {
                        Attendance::create(['fingerprint_id' => $fingerID,'lecture_id' => $lecture->id]);
                        $subject = Subject::find($lecture->subject_id);
                        Mail::to($user->email)->send(new DefaultMail($user,$subject));
                        return 'login';
                    } else {
                        return 'no lecture';
                    }
                }
            }
        }
    }
}
