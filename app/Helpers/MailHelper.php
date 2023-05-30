<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    public static function sendVerification($user){
        $data = ['code' => $user->verification];
        Mail::send('mail.index', $data, function ($message) use ($user){
            $message->from('contact@cashwecan.com', Setting::siteName());
            $message->to($user->email, $user->name)
            ->subject('Email Verification');
        });
    }
     public static function EmailVerified($user){
        $data = ['code' => $user->verification];
        Mail::send('mail.email_verified', $data, function ($message) use ($user){
            $message->from('contact@cashwecan.com', Setting::siteName());
            $message->to($user->email, $user->name)
            ->subject('Account Verification');
        });
    }
    
    public static function send(){
        $Message = '';
        $data['text'] = 'dfgdgdfg';
        $data['name'] = 'fhkajhsd';
        $data['email'] = 'ihuzaifaaslam@gmail.com';
        $data['subject'] = '$Message->subject';
        $data['message'] = '$Message->message';
        Mail::send('admin.mail.index', ['data' => $data], function ($message) use ($Message){
            $message->from('info@cattendance.klickwash.net', "Attendance Management System");
            $message->to('ihuzaifaaslam@gmail.com', 'asdhfkajshd')
            ->subject('Reply from Support');
        });
    }

}
