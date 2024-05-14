<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Mail\NewQuotationMail;
use App\Mail\QuotationUpdatedMail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CustomNotification;
use App\Notifications\NewQuotationNotification;
use App\Notifications\NewQuotationNotificationError;
use App\Notifications\NewQuotationNotificationMailer;
use App\Notifications\NewQuotationNotificationSander;
use App\Notifications\NewQuotationNotificationSubject;
use App\Notifications\NewQuotationNotificationFormatting;
use App\Notifications\NewQuotationNotificationToDatabase;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total_price' => 'required|numeric',
            'taxable_price' => 'nullable|numeric',
            'tax_price' => 'nullable|numeric',
        ]);

        $user = Auth::user();

        $validatedData['user_id'] = $user->id;

        $quotation = Quotation::create($validatedData);

        $quotation->user->notify(new NewQuotationNotification($quotation));

        $quotation->user->notify(new NewQuotationNotificationError($quotation));

        $quotation->user->notify(new NewQuotationNotificationFormatting($quotation));

        $quotation->user->notify(new NewQuotationNotificationSander($quotation));

        $quotation->user->notify(new NewQuotationNotificationSubject($quotation));

        // $quotation->user->notify(new NewQuotationNotificationMailer($quotation));

        $quotation->user->notify(new NewQuotationNotificationToDatabase($quotation));

        $quotation->user->notify(new CustomNotification($quotation));

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

        Mail::to($quotation->user->email)->send(new QuotationUpdatedMail($quotation));

        return redirect()->route('quotations.index')->with('success', 'Quotazione aggiornata con successo!');
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->history()->delete();

        $quotation->delete();

        return response()->json(['message' => 'Quotation deleted successfully'], 200);
    }
}
