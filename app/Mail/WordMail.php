<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $type;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type, $subject, $data)
    {
        $this->subject = $subject;
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $thiss
     */
    public function build()
    {
        switch ($this->type) {
            
            default:
                return $this->subject($this->subject)->view('emails.word');
                break;
        }
    }
}
