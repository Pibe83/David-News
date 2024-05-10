<?php

namespace App\Traits\Models\QuotationHistory;

use App\Models\User;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait QuotationHistoryRelationships
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
}
