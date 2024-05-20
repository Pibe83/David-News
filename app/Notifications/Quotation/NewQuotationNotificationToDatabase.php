<?php

namespace App\Notifications\Quotation;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewQuotationNotificationToDatabase extends Notification
{
    use Queueable;

    protected $quotation;

    public function __construct($quotation)
    {
        $this->quotation = $quotation;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Hello!! New quotation received',
            'quotation_id' => $this->quotation->id,
            'amount' => $this->quotation->amount,
        ];
    }

    public function databaseType($notifiable)
    {
        return 'new-quotation';
    }
}
