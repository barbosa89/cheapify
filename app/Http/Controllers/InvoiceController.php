<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;

class InvoiceController extends Controller
{
    public function index(): View
    {
        $invoices = Invoice::whereCustomer()
            ->with('currency')
            ->latest()
            ->paginate();

        return view('invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load(['products', 'currency']);

        return view('invoices.show', compact('invoice'));
    }
}
