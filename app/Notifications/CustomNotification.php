<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomNotification extends Notification
{
    use Queueable;

    protected $quotation;

    public function __construct($quotation)
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
            ->subject('Custom Notification')
            ->line('This is a custom notification message.')
            ->line('Quotation Total Price: ' . $this->quotation->total_price);
    }

    public function toArray($notifiable)
    {
        return [
            'quotation_id' => $this->quotation->id,
            'total_price' => $this->quotation->total_price,
        ];
    }
}
