<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Donation $donation)
    {
        $this->locale($donation->locale ?: 'tr');
    }

    public function build()
    {
        $this->donation->loadMissing('items');

        return $this->subject(__('site.mail_confirmed_subject', ['ref' => $this->donation->reference]))
            ->view('emails.donation_confirmed');
    }
}
