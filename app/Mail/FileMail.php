<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FileMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $file;
    public $trans;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $file, $trans)
    {
        $this->subject = $subject;
        $this->file = $file;
        $this->trans = $trans;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'item' => $this->trans,
        ];

        return $this->subject($this->subject)
            ->view('emails.confirmed', $data) // Ganti dengan view yang kamu inginkan
            ->attach($this->file);
    }
}
