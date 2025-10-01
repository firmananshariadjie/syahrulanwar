<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function export($id)
    {
        $invoice = Invoice::with([
            'travels.groups.bill'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}
