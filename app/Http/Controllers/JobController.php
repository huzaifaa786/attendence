<?php

namespace App\Http\Controllers;

use App\Mail\AbsentMail;
use App\Mail\DefaultMail;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function sendMails()
    {

        $oneHourAgo = now()->subHour()->format('H:i:s');

        $studentsWithoutAttendance = DB::table('users AS s')
            ->join('courses AS c', 's.course_id', '=', 'c.id')
            ->join('subjects AS sub', 'c.id', '=', 'sub.course_id')
            ->join('lectures AS l', 'sub.id', '=', 'l.subject_id')
            ->join('time_slots AS ts', 'l.timeslot_id', '=', 'ts.id')
            ->leftJoin('attendances AS a', function ($join) use ($oneHourAgo) {
                $join->on('s.fingerprint_id', '=', 'a.fingerprint_id')
                    ->on('l.id', '=', 'a.lecture_id')
                    ->where('a.created_at', '>=', $oneHourAgo);
            })
            ->where('ts.start_time', '>=', $oneHourAgo)
            ->where('ts.end_time', '<=', now()->subMinutes(30)->format('H:i:s'))
            ->whereNull('a.id')
            ->select('s.id AS student_id', 's.fname AS student_name')
            ->distinct()
            ->get();

            // dd($studentsWithoutAttendance);
            // dd($oneHourAgo,now()->subMinutes(30)->format('H:i:s'));
        foreach ($studentsWithoutAttendance as $student) {
            $user = User::find($student->student_id);
            Mail::to($user->guardian_email)->send(new AbsentMail($user));

        }
    }
}
