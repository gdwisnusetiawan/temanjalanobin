<?php

namespace App\Mail;

use App\Config;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Registered extends Mailable
{
    use Queueable, SerializesModels;

    public $config;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->config = Config::first();
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to '.$this->config->name)
            ->markdown('emails.registered')->with([
                'home' => url('/'),
                'login' => route('dashboard.user.index', $this->user)
            ]);
    }
}
