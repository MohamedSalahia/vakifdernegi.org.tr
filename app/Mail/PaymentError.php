<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

class PaymentError extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        return $this->markdown('emails.payment_error')->subject('Payment Error')->from('info@ala3mal.org')->with(['request' => $this->emailData]);
    }
}
