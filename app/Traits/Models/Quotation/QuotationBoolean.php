<?php

namespace App\Traits\Models\Quotation;

trait QuotationBoolean
{
    public function isEditable(): bool
    {
        return $this->is_editable;
    }
}
