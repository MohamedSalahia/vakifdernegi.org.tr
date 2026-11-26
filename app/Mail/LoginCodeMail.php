<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $code, string $locale)
    {
        $this->locale($locale);
    }

    public function build()
    {
        return $this->subject(__('site.login_code_subject', ['code' => $this->code]))->view('emails.login_code');
    }
}
