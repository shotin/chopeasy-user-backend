<?php

namespace App\Mail;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInvoiceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $pdf = Pdf::loadView('emails.invoice', ['order' => $this->order]);

        return $this->subject('Your Order Invoice')
            ->view('emails.invoice')
            ->with(['order' => $this->order])
            ->attachData($pdf->output(), 'Order-' . $this->order->order_number . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
