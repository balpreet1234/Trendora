<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $carts;
    public $pdfOutput;

    public function __construct($order, $carts, $pdfOutput)
    {
        $this->order = $order;
        $this->carts = $carts;
        $this->pdfOutput = $pdfOutput;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Mail for Order #' . $this->order->order_number,
        );
    }

    public function build()
    {
        return $this->view('admin.pages.order.invoice_email')
                    ->with([
                        'order' => $this->order,
                        'carts' => $this->carts,
                    ])
                    ->attachData($this->pdfOutput, "invoice_{$this->order->order_number}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
    }
}
