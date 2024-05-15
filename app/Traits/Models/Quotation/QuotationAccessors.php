<?php

namespace App\Traits\Models\Quotation;

use Illuminate\Support\Str;

trait QuotationAccessors
{
    /**
     * Get the uuid attribute.
     *
     * @return string
     */
    public function getUuidAttribute($value): string
    {
        return Str::uuid($value);
    }

    /**
     * Get the taxable_price attribute.
     *
     * @return float
     */
    public function getTaxableAttribute(): float
    {
        return $this->taxable_price;
    }

    /**
     * Get the taxable_price attribute.
     *
     * @return float
     */
    public function getTaxAttribute(): float
    {
        return $this->tax_price;
    }
}
