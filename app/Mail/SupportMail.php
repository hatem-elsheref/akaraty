<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public Contact $contact;
    public string  $title;
    public string  $address;
    public function __construct(Contact $contact,string $title='',string $address='')
    {
        $this->contact=$contact;
        $this->title=$title;
        $this->address=$address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.support')->subject("Customer Message")
            ->with('contact',$this->contact)
            ->with('title',$this->title)
            ->with('address',$this->address);
    }
}
