<?php

namespace App\Notifications\Quotation;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewQuotationNotificationSubject extends Notification
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

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notification Subject new')
            ->line('Pagamenti');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Nuova notifica soggetto',
        ];
    }
}
