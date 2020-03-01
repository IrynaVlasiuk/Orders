<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrdersTableNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $view, $data)
    {
        $this->subject = $subject;
        $this->view = $view;
        $this->data = $data;

        $this->from = ['address' => env('MAIL_FROM_ADDRESS', 'orders@orders.com')];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from)
            ->view($this->view)
            ->subject($this->subject)
            ->with(['orders' => $this->data]);
    }
}
