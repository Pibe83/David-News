<?php

namespace App\Traits;

trait TaxableTrait
{
    public function getTaxableAttribute()
    {
        return $this->taxable_price;
    }

    public function setTaxableAttribute($value)
    {
        $this->attributes['taxable_price'] = $value;
    }
}
