<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $mail;
    public $body;
    public $phone;
    public $name;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$mail,$body,$phone,$name)
    {
        $this->title = $title;
        $this->mail = $mail;
        $this->body = $body;
        $this->phone = $phone;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contactus@laravel.309')
        ->view('emails.mymail');
    }
}
