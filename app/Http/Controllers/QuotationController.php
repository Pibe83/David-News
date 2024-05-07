<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        // Recupera tutte le quotazioni dal database
        $quotations = Quotation::all();

        // Ritorna la vista index con le quotazioni recuperate
        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        // Ritorna la vista per creare una nuova quotazione
        return view('quotations.create');
    }

    public function store(Request $request)
    {
        // Validazione dei dati del form
        $validatedData = $request->validate([
            'total_price' => 'required|numeric',
            'taxable_price' => 'required|numeric',
            'tax_price' => 'nullable|numeric',
        ]);

        // Salva la nuova quotazione nel database
        Quotation::create($validatedData);

        // Ritorna una risposta appropriata
        return redirect()->route('quotations.index')
            ->with('success', 'Quotazione creata con successo!');
    }

    public function show(Quotation $quotation)
    {
        // Ritorna la vista per visualizzare una singola quotazione
        return view('quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        // Ritorna la vista per modificare una quotazione esistente
        return view('quotations.edit', compact('quotation'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        // Validazione dei dati del form
        $validatedData = $request->validate([
            // Inserisci qui le regole di validazione per i dati della quotazione
        ]);

        // Aggiorna la quotazione nel database
        $quotation->update($validatedData);

        // Ritorna una risposta appropriata
        return redirect()->route('quotations.index')
            ->with('success', 'Quotazione aggiornata con successo!');
    }

    public function destroy(Quotation $quotation)
    {
        // Elimina la quotazione dal database
        $quotation->delete();

        // Ritorna una risposta appropriata
        return redirect()->route('quotations.index')
            ->with('success', 'Quotazione eliminata con successo!');
    }
}
