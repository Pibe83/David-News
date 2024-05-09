<?php

namespace App\Http\Controllers;

use App\Models\QuotationHistory;

class QuotationHistoryController extends Controller
{
    public function index()
    {
        $history = QuotationHistory::all();

        return view('quotation_history.index', compact('history'));
    }

    public function show($id)
    {
        $history = QuotationHistory::findOrFail($id);

        return view('quotation_history.show', compact('history'));
    }
}
