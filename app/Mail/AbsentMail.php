<?php

namespace App\Mail;

use App\EmailTemplate;
use App\Models\Subject;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AbsentMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.absent')
            ->subject('Attendance')
            ->from('info@attendance.klickwash.net','UOS Absent Attendance Alert')
            ->with([
                'user' => $this->user,
            ]);
    }
}