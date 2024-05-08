<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Quotation\QuotationMutators;
use App\Traits\Models\Quotation\QuotationAccessors;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory,
        QuotationAccessors,
        QuotationMutators;

    protected $fillable = [
        'uuid',
        'total_price',
        'taxable_price',
        'tax_price',
        'is_editable',
        'user_id',
    ];
}
