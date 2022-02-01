<?php

namespace App\Observers;

use App\Models\Invoice;
use Illuminate\Support\Str;

class InvoiceObserver
{
    /**
     * Handle the Invoice "creating" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function creating(Invoice $invoice)
    {
        $invoice->reference = strtoupper(Str::random(16));
    }
}
