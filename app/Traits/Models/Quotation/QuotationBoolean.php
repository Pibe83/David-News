<?php

namespace App\Traits\Models\Quotation;

trait QuotationBoolean
{
    /**
     * Check if it is editable.
     *
     * @return bool
     */
    public function isEditable(): bool
    {
        return $this->is_editable;
    }
}
