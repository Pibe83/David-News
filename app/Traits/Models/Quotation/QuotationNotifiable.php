<?php

namespace App\Traits;

use App\Notifications\NewQuotationNotification;

trait NotifiableQuotation
{
    public static function createWithNotification(array $data)
    {
        $quotation = static::create($data);

        $quotation->user->notify(new NewQuotationNotification($quotation));

        return $quotation;
    }
}
