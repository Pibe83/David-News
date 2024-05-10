<?php

namespace App\Traits\Models\Quotation;

use App\Models\User;
use App\Models\QuotationHistory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait QuotationRelationships
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(QuotationHistory::class, 'quotation_id');
    }
}
