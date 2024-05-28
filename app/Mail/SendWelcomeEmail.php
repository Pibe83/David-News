<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $subject;

    //  public $defaultsubject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $subject)
    {
        $this->user = $user;
        $this->subject = $subject ?? 'Mario';
        // $this->defaultsubject = $defaultsubject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome')
            ->subject($this->subject)
            ->with([
                'name' => $this->user->name,
            ]);
    }
}
