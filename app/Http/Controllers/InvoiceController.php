<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\User;
use App\Services\InvoiceService;
use Inertia\Inertia;
use Illuminate\Http\Response;
use Inertia\Response as InertiaResponse;
use \Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Throwable;

// TODO:
// The following is a wishlist from yours truly.
// * [ ] Create authentication for the user to login
// * [X] An user is tied to a company
// * [X] The fromCompany will always be the logged in users company
// * [X] The toCompany can be selected in a select box
// * [ ] Eventual extra would be to make a user relations table to see which user works for who
// * [ ] User can create his own "products", also in a separate view
// * [ ] User can log his own hours in a calendar type view

class InvoiceController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Invoice/Index', [
            'invoices' => InvoiceResource::collection(
                Invoice::forAuthenticatedUser()->get()
            )
        ]);
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Invoice/Create', [
            'companies' => Company::withoutAuthenticatedUserCompany()->get()
        ]);
    }

    public function store(CreateInvoiceRequest $request): SymfonyResponse
    {
        // @TODO should be Auth::user()
        $user = User::first();

        Invoice::create([
            'user_id' => $user->id,
            'from_company_id' => $user->company_id,
            'to_company_id' => $request->company_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return redirect()->route('invoice.index');
    }

    /**
     * @throws Throwable
     */
    public function show(Invoice $invoice): Response
    {
        $invoiceService = new InvoiceService();

        return $invoiceService->generatePDF($invoice);
    }

    public function edit(Invoice $invoice): void
    {
        // @TODO add edit capabilities
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice): void
    {
        // @TODO update invoice
    }

    public function destroy(Invoice $invoice): SymfonyResponse
    {
        $invoice->delete();

        return redirect()->route('invoice.index');
    }
}
