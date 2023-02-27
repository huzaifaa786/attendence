<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                    $log = Attendance::create(['fingerprint_id' => $fingerID]);
                    return 'login';
                }
            }

            // An available Fingerprint has been detected

        }
    }
}
