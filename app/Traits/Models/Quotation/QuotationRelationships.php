<?php

namespace App\Traits\Models\Quotation;

use App\Models\User;

trait QuotationRelationships
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
