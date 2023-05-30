<?php

namespace App\Mail;

use App\EmailTemplate;
use App\Models\Subject;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DefaultMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $msubject;

    public $user;
    public function __construct($user,$msubject)
    {
        $this->user = $user;
        $this->msubject = $msubject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.index')
            ->subject('Attendance')
            ->from('info@attendance.klickwash.net','asdfasdf')
            ->with([
                'user' => $this->user,
                'subject' => $this->subject,
            ]);
    }
}