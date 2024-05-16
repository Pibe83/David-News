<?php

namespace App\Jobs;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CustomNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\NewQuotationNotification;
use App\Notifications\NewQuotationNotificationError;
use App\Notifications\NewQuotationNotificationSander;
use App\Notifications\NewQuotationNotificationSubject;
use App\Notifications\NewQuotationNotificationFormatting;
use App\Notifications\NewQuotationNotificationToDatabase;

class SendQuotationNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $quotation;

    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    public function handle()
    {
        $this->quotation->user->notify(new NewQuotationNotification($this->quotation));

        $this->quotation->user->notify(new NewQuotationNotificationError($this->quotation));

        $this->quotation->user->notify(new NewQuotationNotificationFormatting($this->quotation));

        $this->quotation->user->notify(new NewQuotationNotificationSander($this->quotation));

        $this->quotation->user->notify(new NewQuotationNotificationSubject($this->quotation));

        // $quotation->user->notify(new NewQuotationNotificationMailer($quotation));

        $this->quotation->user->notify(new NewQuotationNotificationToDatabase($this->quotation));

        $this->quotation->user->notify(new CustomNotification($this->quotation));
    }
}
