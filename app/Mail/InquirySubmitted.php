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
    public $requestUrl;
    public $subject = 'Contact Form Submission';

    /**
     * InquirySubmitted constructor.
     * @param Inquiry $inquiry
     * @param string $requestUrl
     */
    public function __construct(Inquiry $inquiry, string $requestUrl)
    {
        $this->inquiry = $inquiry;
        $this->requestUrl = $requestUrl;
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