<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Mail\NewQuotationMail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreQuotationRequest;
use App\Jobs\Quotation\SendQuotationNotificationJob;
use App\Jobs\Quotation\SendQuotationUpdatedEmailJob;
use Symfony\Component\HttpFoundation\RedirectResponse;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::all();

        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        return view('quotations.create');
    }

    public function store(StoreQuotationRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user->id;

        $quotation = Quotation::create($validatedData);

        SendQuotationNotificationJob::dispatch($quotation)->onQueue('notifications');

        //   Mail::to('davidscattone10@gmail.com')->send(new NewQuotationMail($quotation));

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

        SendQuotationUpdatedEmailJob::dispatch($quotation)->onQueue('email');

        return redirect()->route('quotations.index')->with('success', 'Quotazione aggiornata con successo!');
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->history()->delete();

        $quotation->delete();

        return response()->json(['message' => 'Quotation deleted successfully'], 200);
    }
}
