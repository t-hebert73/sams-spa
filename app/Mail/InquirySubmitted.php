<?php

namespace AlescoSalon\Mail;

use AlescoSalon\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InquirySubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $subject = 'Contact Form Submission';

    /**
     * VolunteerRequested constructor.
     * @param Inquiry $inquiry
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.inquiry-submitted');
    }
}