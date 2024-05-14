<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewQuotationNotificationError extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed       $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->error()
            ->subject('Errore nella creazione della nuova quotazione')

            ->line('Si è verificato un errore durante la creazione della nuova quotazione.')
            ->line('Per favore, contatta il supporto per ulteriori informazioni.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'error_message' => 'Message describing the error',
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'error_message' => 'Message describing the error',
        ];
    }
}
