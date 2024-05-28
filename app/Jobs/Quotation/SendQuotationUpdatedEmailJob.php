<?php

namespace App\Jobs\Quotation;

use App\Models\Quotation;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use App\Mail\QuotationUpdatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendQuotationUpdatedEmailJob implements ShouldQueue
{
    use Batchable,
        Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    protected $quotation;

    /**
     * Create a new job instance.
     *
     * @param  Quotation $quotation
     * @return void
     */
    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->batch() && $this->batch()->cancelled()) {
            return;
        }

        Mail::to($this->quotation->user->email)->send(new QuotationUpdatedMail($this->quotation));
    }
}
