<?php

namespace App\Mail;

use App\Config;
use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Ordered extends Mailable
{
    use Queueable, SerializesModels;

    public $config;
    public $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->config = Config::first();
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Waiting for Payment')
            ->markdown('emails.ordered')->with([
                'url' => route('dashboard.payment', $this->payment)
            ]);
    }
}
