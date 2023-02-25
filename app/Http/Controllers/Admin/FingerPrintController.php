<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FingerPrintController extends Controller
{
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

        $canAddFingerprint = User::where('has_finger_id', 1)->exists();
        if ($canAddFingerprint) {
            return "You can't add more than one ID each time";
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
            if ($request->input('Get_Fingerid') == 'get_id') {
                $sql = "SELECT fingerprint_id FROM users WHERE has_finger_id=1 AND enrolled=0";
                $result = DB::select($sql);
                if ($result) {
                    $row = $result[0];
                    return response()->json(['message' => 'add-id' . $row->fingerprint_id]);
                } else {
                    return response()->json(['message' => 'Nothing']);
                }
            } else {
                return response()->json(['message' => 'Invalid request']);
            }
        } else {
            return response()->json(['message' => 'Missing parameters']);
        }
    }

    public function handleFingerID(Request $request)
    {
        if ($request->has('FingerID')) {
            $fingerID = $request->input('FingerID');

            $user = DB::table('users')->where('fingerprint_id', $fingerID)->first();

            if ($user) {
                // An existed fingerprint has been detected for Login or Logout
                if (!empty($user->username)) {
                    // $Uname = $user->username;
                    // $Number = $user->serialnumber;

                    // $log = DB::table('users_logs')
                    //     ->where('fingerprint_id', $fingerID)
                    //     ->whereDate('checkindate', Carbon::today())
                    //     ->where('timeout', '')
                    //     ->first();

                    // // Login
                    // if (!$log) {
                    //     DB::table('users_logs')->insert([
                    //         'username' => $Uname,
                    //         'serialnumber' => $Number,
                    //         'fingerprint_id' => $fingerID,
                    //         'checkindate' => Carbon::today(),
                    //         'timein' => Carbon::now(),
                    //         'timeout' => '',
                    //     ]);
                    //     return response()->json(['status' => 'success', 'message' => 'login'.$Uname]);
                    // }
                    // // Logout
                    // else {
                    //     DB::table('users_logs')
                    //         ->where('fingerprint_id', $fingerID)
                    //         ->whereDate('checkindate', Carbon::today())
                    //         ->update(['timeout' => Carbon::now()]);
                    //     return response()->json(['status' => 'success', 'message' => 'logout'.$Uname]);
                    // }
                }
                // An available Fingerprint has been detected
                else {
                    $finger_sel = DB::table('users')
                        ->where('fingerprint_select', 1)
                        ->first();

                    if ($finger_sel) {
                        DB::table('users')
                            ->where('fingerprint_select', 1)
                            ->update(['fingerprint_select' => 0]);

                        DB::table('users')
                            ->where('fingerprint_id', $fingerID)
                            ->update(['fingerprint_select' => 1]);

                        return response()->json(['status' => 'success', 'message' => 'available']);
                    } else {
                        DB::table('users')
                            ->where('fingerprint_id', $fingerID)
                            ->update(['fingerprint_select' => 1]);

                        return response()->json(['status' => 'success', 'message' => 'available']);
                    }
                }
            }
            // New Fingerprint has been added
            else {
                $Uname = "";
                $Number = "";
                $gender = "";

                $finger_sel = DB::table('users')
                    ->where('fingerprint_select', 1)
                    ->first();

                if ($finger_sel) {
                    DB::table('users')
                        ->where('fingerprint_select', 1)
                        ->update(['fingerprint_select' => 0]);
                }

                DB::table('users')->insert([
                    'username' => $Uname,
                    'serialnumber' => $Number,
                    'gender' => $gender,
                    'fingerprint_id' => $fingerID,
                    'fingerprint_select' => 1,
                ]);

                return response()->json(['status' => 'success', 'message' => 'succesful1']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Missing FingerID parameter']);
        }
    }
}
