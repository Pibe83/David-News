<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\QuotationHistory;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::all();

        // Itera attraverso ogni quotazione e recupera lo storico delle modifiche
        foreach ($quotations as $quotation) {
            $quotation->history = QuotationHistory::where('quotation_id', $quotation->id)->latest()->get();
        }

        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        return view('quotations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total_price' => 'required|numeric',
            'taxable_price' => 'nullable|numeric',
            'tax_price' => 'nullable|numeric',
        ]);

        $user = Auth::user();

        $validatedData['user_id'] = $user->id;

        Quotation::create($validatedData);

        return redirect()->route('quotations.store')
            ->with('success', 'Quotazione creata con successo!');
    }

    public function show(Quotation $quotation)
    {
        return view('quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        if (! auth()->user()->isAdmin()) {
            return redirect()->route('quotations.index')
                ->with('error', 'Solo gli amministratori possono modificare le quotazioni.');
        }

        return view('quotations.edit', compact('quotation'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        if (! auth()->user()->isAdmin()) {
            return redirect()->route('quotations.index')->with('error', 'Solo gli amministratori possono aggiornare le quotazioni.');
        }

        $validatedData = $request->validate([
            'total_price' => 'required|numeric',
            'taxable_price' => 'nullable|numeric',
            'tax_price' => 'nullable|numeric',
        ]);

        $quotation->update($validatedData);

        return redirect()->route('quotations.index')->with('success', 'Quotazione aggiornata con successo!');
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->history()->delete();

        $quotation->delete();

        return response()->json(['message' => 'Quotation deleted successfully'], 200);
    }
}
