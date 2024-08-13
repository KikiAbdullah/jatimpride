<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $file)
    {
        $this->subject = $subject;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            // ->view('emails.sendmail') // Ganti dengan view yang kamu inginkan
            ->attach($this->file);
    }
}
