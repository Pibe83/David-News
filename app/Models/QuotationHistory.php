<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Importa il trait
use App\Traits\Models\QuotationHistory\QuotationHistoryRelationships;

class QuotationHistory extends Model
{
    use QuotationHistoryRelationships;

    protected $table = 'quotation_history';

    protected $fillable = ['quotation_id', 'user_id', 'action'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
}
