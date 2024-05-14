<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewQuotationNotificationFormatting extends Notification
{
    use Queueable;

    protected $quotation;

    // protected $quotation;

    public function __construct($quotation)
    {
        $this->quotation = $quotation;
        // $this->quotation = $quotation;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'mail.invoice.paid',
            ['quotation' => $this->quotation]
        );
    }

    public function toArray($notifiable)
    {
        return [
            'quotation_id' => $this->quotation->id,
            'total_price' => $this->quotation->total_price,
            'taxable_price' => $this->quotation->taxable_price,
            'tax_price' => $this->quotation->tax_price,
        ];
    }
}
