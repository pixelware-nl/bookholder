<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoiceRequest;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\User;
use App\Services\InvoiceService;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Throwable;

// TODO:
// The following is a wishlist from yours truly.
// * Create authentication for the user to login
// * An user is tied to a company
// * The fromCompany will always be the logged in users company
// * The toCompany can be selected in a select box
// * * Eventual extra would be to make a user relations table to see which user works for who
// * User can create his own "products", also in a seperate view
// * User can log his own hours in a calendar type view

class InvoiceController extends Controller
{
    public function create(): InertiaResponse
    {
        $companies = Company::all();

        return Inertia::render('Admin/Invoice/Create', [
            'companies' => $companies
        ]);
    }

    public function store(CreateInvoiceRequest $request)
    {
        $user = User::first();

        $invoice = new Invoice();

        $invoice->user_id = $user->id;
        $invoice->from_company_id = $user->company_id;
        $invoice->to_company_id = $request->company_id;
        $invoice->start_date = $request->start_date;
        $invoice->end_date = $request->end_date;

        $invoice->save();

        return Inertia::location(route('invoice.show', $invoice));
    }

    /**
     * @throws Throwable
     */
    public function show(Invoice $invoice): Response
    {
        $invoiceService = new InvoiceService();

        return $invoiceService->generatePDF($invoice);
    }
}
