<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hash;
    public $name;
    public $surname;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($hash, $name, $surname)
    {
        $this->hash = $hash;
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //  return $this->subject(__('properties.reset_password_subject'))
        //    ->view('admin/login/reset-password-mail');

        return $this
            ->from('muzicariRM@gmail.com')
            ->subject( __('properties.global.title'))
            ->view('admin/login/password-reset-mail')
            ->with('name', ($this->name.' '.$this->surname));
    }
}
