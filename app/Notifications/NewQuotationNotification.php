<?php

namespace App\Notifications;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewQuotationNotification extends Notification
{
    use Queueable;

    /**
     * The quotation instance.
     *
     * @var Quotation
     */
    protected $quotation;

    /**
     * Create a new notification instance.
     *
     * @param Quotation $quotation
     */
    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
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
    public function toMail($notifiable)
    {
        $attachmentPath = public_path('pdf/SCTGNN53L04I992J_001709114340933_202403_01.pdf');

        return (new MailMessage)
            ->line('New quotation created:')
            ->line('Total price: ' . $this->quotation->total_price)
            ->line('Taxable price: ' . $this->quotation->taxable_price)
            ->line('Tax price: ' . $this->quotation->tax_price)
            ->attach($attachmentPath);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
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
