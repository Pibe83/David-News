<?php

namespace App\Traits\Models\Quotation;

trait QuotationMutators
{
    public function setTaxableAttribute($value)
    {
        $this->attributes['taxable_price'] = $value;
    }

    public function setTaxAttribute($value)
    {
        $this->attributes['tax_price'] = $value;
    }

    public function setTotalPriceAttribute($value)
    {
        $this->attributes['total_price'] = $value;
        $this->attributes['taxable_price'] = $value / (1 + $this->getTaxRate());
        $this->attributes['tax_price'] = $value - $this->attributes['taxable_price'];
    }

    protected function getTaxRate()
    {
        return 0.20;
    }
}
