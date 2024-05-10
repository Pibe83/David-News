<?php

namespace App\Traits\Models\Quotation;

use Illuminate\Support\Str;

trait QuotationAccessors
{
    public function getUuidAttribute($value): string
    {
        return Str::uuid($value);
    }

    public function getTaxableAttribute()
    {
        return $this->taxable_price;
    }

    public function getTaxAttribute()
    {
        return $this->tax_price;
    }
}
