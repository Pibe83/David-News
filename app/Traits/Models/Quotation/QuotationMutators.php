<?php

namespace App\Traits\Models\Quotation;

trait QuotationMutators
{
    /**
     * Set the taxable_price attribute.
     *
     * @param  string $value
     * @return void
     */
    public function setTaxableAttribute($value): void
    {
        $this->attributes['taxable_price'] = $value;
    }

    /**
     * Set the tax_price attribute.
     *
     * @param  string $value
     * @return void
     */
    public function setTaxAttribute($value): void
    {
        $this->attributes['tax_price'] = $value;
    }

    /**
     * Set the total_price attribute.
     *
     * @param  string $value
     * @return void
     */
    public function setTotalPriceAttribute($value): void
    {
        $this->attributes['total_price'] = $value;
        $this->attributes['taxable_price'] = $value / (1 + $this->getTaxRate());
        $this->attributes['tax_price'] = $value - $this->attributes['taxable_price'];
    }

    /**
     * Retrieve tax rate.
     *
     * @return float
     */
    protected function getTaxRate(): float
    {
        return 0.22;
    }
}
