<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use App\Jobs\Quotation\SendQuotationNotificationJob;
use App\Jobs\Quotation\SendQuotationUpdatedEmailJob;

class BatchController extends Controller
{
    public function createBatch(Request $request)
    {
        $quotationId = $request->input('quotation_id');
        $quotation = Quotation::findOrFail($quotationId);

        $batch = Bus::batch([
            new SendQuotationNotificationJob($quotation),
            new SendQuotationUpdatedEmailJob($quotation),
        ])->dispatch();

        return response()->json(['batch_id' => $batch->id]);
    }

    public function getBatchStatus($batchId)
    {
        $batch = Bus::findBatch($batchId);

        if ($batch) {
            return response()->json([
                'id' => $batch->id,
                'name' => $batch->name,
                'totalJobs' => $batch->totalJobs,
                'pendingJobs' => $batch->pendingJobs,
                'failedJobs' => $batch->failedJobs,
                'processedJobs' => $batch->processedJobs,
                'progress' => $batch->progress(),
                'finished' => $batch->finished(),
                'cancelled' => $batch->cancelled(),
            ]);
        }

        return response()->json(['message' => 'Batch not found'], 404);
    }
}
