<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contacts extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $name;
    public $mobile;
    public $mobile2;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->subject = $contact->subject;
        $this->body = $contact->body;
        $this->name = $contact->customer->name;
        $this->mobile = $contact->customer->first_phone;
        $this->mobile2 = $contact->customer->second_phone;
        $this->email = $contact->customer->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.contact', [
            'subject'=> $this->subject,
            'body'=> $this->body,
            'name'=> $this->name,
            'email'=> $this->email,
            'firstPhone'=> $this->mobile,
            'secondPhone'=> $this->mobile2
            ]);
    }
}
