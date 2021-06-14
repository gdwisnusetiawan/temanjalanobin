<?php

namespace App\Mail;

use App\Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSent extends Mailable
{
    use Queueable, SerializesModels;

    public $config;
    public $name;
    public $email;
    public $subjects;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $subjects, $message)
    {
        $this->config = Config::first();
        $this->name = $name;
        $this->email = $email;
        $this->subjects = $subjects;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Message - '.$this->subjects)
            ->markdown('emails.message-sent')->with([
                'url' => 'mailto:'.$this->email
            ]);
    }
}
