<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewQuotationNotificationSander extends Notification
{
    use Queueable;

    protected $invoice;

    public function __construct()
    {
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
        ];
    }
}
