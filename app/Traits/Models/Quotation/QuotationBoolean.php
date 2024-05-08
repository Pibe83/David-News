<?php

namespace App\Traits\Models\Quotation;

trait QuotationBoolean
{
    public function isEditable()
    {
        return $this->is_editable;
    }
}
