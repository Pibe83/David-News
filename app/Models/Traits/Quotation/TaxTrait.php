<?php

namespace App\Traits;

trait TaxTrait
{
    public function getTaxAttribute()
    {
        return $this->tax_price;
    }

    public function setTaxAttribute($value)
    {
        $this->attributes['tax_price'] = $value;
    }
}
