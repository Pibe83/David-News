<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\QuotationHistory\QuotationHistoryRelationships;

class QuotationHistory extends Model
{
    use QuotationHistoryRelationships;

    protected $table = 'quotation_history';

    protected $fillable = [
        'quotation_id',
        'user_id',
        'action',
        'modified_value',
    ];
}
