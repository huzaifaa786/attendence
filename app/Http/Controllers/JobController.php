<?php

namespace App\Http\Controllers;

use App\Mail\DefaultMail;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function sendMails()
    {
        $subject = Subject::find(1);
        $user = User::find(1);

        Mail::to($user->email)->send(new DefaultMail($user, $subject));
        return 'mail sent';
    }
}
