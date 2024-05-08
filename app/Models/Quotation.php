<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Quotation\QuotationBoolean;
use App\Traits\Models\Quotation\QuotationMutators;
use App\Traits\Models\Quotation\QuotationAccessors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Models\Quotation\QuotationRelationships;

class Quotation extends Model
{
    use HasFactory,
        QuotationAccessors,
        QuotationBoolean,
        QuotationMutators,
        QuotationRelationships;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at',
        'updated_at',
    ];
}
