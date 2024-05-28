<?php

namespace App\Jobs\Quotation;

use App\Models\Quotation;
use Illuminate\Bus\Batchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessQuotationCreation implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $validatedData;

    /**
     * Create a new job instance.
     *
     * @param  array $validatedData
     * @return void
     */
    public function __construct(array $validatedData)
    {
        $this->validatedData = $validatedData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->batch() && $this->batch()->cancelled()) {
            // Determina se il batch è stato annullato
            return;
        }

        Quotation::create($this->validatedData);
    }
}
