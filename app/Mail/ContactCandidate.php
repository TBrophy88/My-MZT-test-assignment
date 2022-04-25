<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Company;

class ContactCandidate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company_name = Company::find(1)->name;
        $sender_address = "hiring.manager@" . urlencode($company_name) . ".com";

        return $this->from($sender_address, $company_name)
            ->subject("Are you interested in joining {$company_name}?")
            ->text('emails.contact');
    }
}
