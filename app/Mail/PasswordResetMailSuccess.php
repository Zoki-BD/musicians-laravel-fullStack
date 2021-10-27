<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMailSuccess extends Mailable
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
    public function __construct( $name, $surname)
    {
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
            ->from('muzicariRM@gmail.com') // od ovoj mail ke prakjame ustvari mail kon userot
            ->subject( __('properties.global.title')) //Nazivot daden vo properties na aplikacijata
            ->view('admin/login/password-reset-mail-success') //view-to so porakata
            ->with('name', ($this->name.' '.$this->surname)); //Da pisuva Zdravo, name i surname
    }
}
