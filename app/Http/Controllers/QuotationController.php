<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Mail\NewQuotationMail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

        $user = Auth::user();

        $city = $user->city;

        $days = 3;

        $weatherData = $this->getWeatherData($city);

        $weatherDataLocation = $weatherData['location'];

        return view('quotations.index', compact('quotations', 'weatherData', 'city', 'weatherDataLocation'));
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

        $batch = Bus::batch([
            new SendQuotationNotificationJob($quotation),
            new SendQuotationUpdatedEmailJob($quotation),
        ])->before(function ($batch) {
        })->progress(function ($batch) {
        })->then(function ($batch) {
            Log::info('Tutti i job del batch sono stati completati con successo!');
        })->catch(function ($batch, Throwable $e) {
            Log::error('Errore nel batch: ' . $e->getMessage());
        })->finally(function ($batch) {
            Log::info('Il batch è stato completato!');
        })->name('Process News Batch')->dispatch();

        SendQuotationNotificationJob::dispatch($quotation)->onQueue('notifications');

        //   Mail::to('davidscattone10@gmail.com')->send(new NewQuotationMail($quotation));

        $response = Http::get('http://api.weatherapi.com/v1/current.json?key=d95b844868dd480783093751242105&q=Rome');

        dd($response->json());

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

    public function search(Request $request)
    {
        $quotations = Quotation::all();

        $city = $request->input('city');

        $days = 3;

        $weatherData = $this->getWeatherData($city);

        return view('quotations.index', compact('quotations', 'weatherData', 'city'));
    }

    public function getWeatherData($city, $days = 3)
    {
        $response = Http::get('http://api.weatherapi.com/v1/forecast.json', [
            'key' => 'd95b844868dd480783093751242105',
            'q' => $city,
            'days' => $days,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
