<?php

namespace App\Observers;

use App\Models\Quotation;
use Illuminate\Support\Str;
use App\Models\QuotationHistory;

class QuotationObserver
{
    public function creating(Quotation $quotation)
    {
        $quotation->uuid = Str::uuid();
    }

    public function created(Quotation $quotation)
    {
        $this->saveHistory($quotation, 'created');
    }

    public function updated(Quotation $quotation)
    {
        $this->saveHistory($quotation, 'updated');
    }

    public function deleted(Quotation $quotation)
    {
        $this->saveHistory($quotation, 'deleted');
    }

    protected function saveHistory(Quotation $quotation, string $action)
    {
        // Salva lo storico delle modifiche
        QuotationHistory::create([
            'quotation_id' => $quotation->id,
            'user_id' => auth()->id(),
            'action' => $action,
        ]);
    }
}
