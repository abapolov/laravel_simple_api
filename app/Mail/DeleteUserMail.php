<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeleteUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * DeleteUserMail constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
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
        return $this
            ->from($this->data['from'], $this->data['from_name'])
            ->subject($this->data['subject'])
            ->text('emails.user_delete');
    }
}
