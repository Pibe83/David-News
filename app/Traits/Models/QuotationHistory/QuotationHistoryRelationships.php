<?php

namespace App\Traits\Models\QuotationHistory;

use App\Models\User;
use App\Models\Quotation;

trait QuotationHistoryRelationships
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
}
