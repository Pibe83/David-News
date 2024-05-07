<?php

namespace App\Observers;

use App\Models\Quotation;
use Illuminate\Support\Str;

class QuotationObserver
{
    public function creating(Quotation $quotation)
    {
        $quotation->uuid = Str::uuid();
    }
}
