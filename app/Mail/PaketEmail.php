<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaketEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('penitipanpaket@gmail.com')
            ->subject('Paket Barang Diterima')
            ->view('mail.paket')
            ->with([
                'nik' => $this->data['nik'],
                'nama' => $this->data['nama'],
                'tanggal_sampai' => $this->data['tanggal_sampai'],
                'link' => $this->data['link']
            ]);
    }
}
