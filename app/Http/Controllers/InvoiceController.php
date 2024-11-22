<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoices\CreateInvoiceRequest;
use App\Http\Requests\Invoices\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\UserCompany;
use App\Services\InvoiceService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Throwable;

final class InvoiceController extends Controller
{
    // TODO adde repository for this

    public function __construct(
        private readonly InvoiceService $invoiceService
    ) {}

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
            'companies' => Auth::user()->companies()->get()
        ]);
    }

    public function store(CreateInvoiceRequest $request): SymfonyResponse
    {
        $user = Auth::user();

        Invoice::create([
            'user_id' => $user->id,
            'from_company_id' => $user->company_id,
            'to_company_id' => $request->company_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return redirect()->route('invoices.index');
    }

    /**
     * @throws Throwable
     */
    public function show(Invoice $invoice): Response
    {
        return $this->invoiceService->generatePDF($invoice);
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

        return redirect()->route('invoices.index');
    }
}
