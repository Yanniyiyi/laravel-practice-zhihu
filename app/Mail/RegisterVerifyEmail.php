<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->view('emails.registerverify')->with([
                'userName' => $this->user->name,
                'url' => route('email.verify',['confirmation_token' => $this->user->confirmation_token])
            ]);;
    }
}
