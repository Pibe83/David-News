<?php

namespace App\Traits\Models\Quotation;

use App\Models\User;
use App\Models\QuotationHistory;

trait QuotationRelationships
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->hasMany(QuotationHistory::class, 'quotation_id');
    }
}
