<?php

namespace App\Notifications;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewQuotationNotificationSander extends Notification
{
    use Queueable;

    protected $quotation;

    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from('barrett@example.com', 'Barrett Blair')
            ->line('Pagamento effettuato');
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
