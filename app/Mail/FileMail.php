<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

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
    public function __construct($file, $trans)
    {
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

        $text = '';
        $subject = '';

        switch ($this->trans->status) {
            case 'open':
                $subject = 'Pemesanan ' . $this->trans->no . ' Diterima';
                $text   = 'Pesanan Anda sudah masuk. Kami sedang menyiapkannya, harap tunggu email konfirmasi.';
                break;
            case 'confirm':
                $subject = 'Pemesanan ' . $this->trans->no . ' Dikonfirmasi';
                $text   = 'Pesanan Anda telah dikonfirmasi. Kami akan segera memprosesnya dan mengirimkan detail lebih lanjut.';
                break;
            case 'closed':
                $subject = 'Pemesanan ' . $this->trans->no . ' Selesai';
                $text   = 'Pesanan Anda telah selesai dan dikirimkan. Terima kasih telah berbelanja dengan kami!';
                break;
            case 'reject':
                $subject = 'Pemesanan ' . $this->trans->no . ' Ditolak';
                $text   = 'Sayangnya, pesanan Anda telah ditolak. Jika Anda memiliki pertanyaan, silakan hubungi layanan pelanggan kami.';
                break;
        }

        $data = [
            // 'logo'  => imgToBase64(public_path('app_local/img/logo.png')),
            'logo'  => asset('app_local/img/logo.png'),
            'item' => $this->trans,
            'title'  => $subject,
            'text'  => $text,
        ];

        if ($this->file != '') {
            if (Storage::exists('public/' . $this->file)) {
                return $this->subject($subject)
                    ->view('emails.jatimpride', $data) // Ganti dengan view yang kamu inginkan
                    ->attach(storage_path('app/public/' . $this->file));
            } else {
                return $this->subject($subject)
                    ->view('emails.jatimpride', $data);
            }
        } else {
            return $this->subject($subject)
                ->view('emails.jatimpride', $data);
        }
    }
}
