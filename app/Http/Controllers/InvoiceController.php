<?php

namespace App\Http\Controllers;

use App\DTO\InvoiceDTO;
use App\Http\Requests\Invoices\CreateInvoiceRequest;
use App\Http\Requests\Invoices\UpdateInvoiceRequest;
use App\Http\Resources\EditInvoiceResource;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Services\InvoiceService;
use App\Services\UserService;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Throwable;

final class InvoiceController extends Controller
{
    public function __construct(
        private readonly InvoiceService $invoiceService,
        private readonly UserService $userService
    ) {}

    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Invoice/Index', [
            'invoices' => InvoiceResource::collection(
                $this->invoiceService->all()
            )
        ]);
    }

    /**
     * @throws Throwable
     */
    public function show(Invoice $invoice): Response
    {
        return $this->invoiceService->generatePDF($invoice);
    }

    public function store(CreateInvoiceRequest $request): SymfonyResponse
    {
        $this->invoiceService->store(InvoiceDTO::fromRequest($request));

        return redirect()->route('invoices.index');
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Invoice/Create', [
            'companies' => $this->userService->companies()
        ]);
    }

    public function edit(Invoice $invoice): InertiaResponse
    {
        return Inertia::render('Admin/Invoice/Edit', [
            'invoice' => EditInvoiceResource::make($invoice),
            'companies' => $this->userService->companies()
        ]);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice): SymfonyResponse
    {
        $this->invoiceService->update($invoice, InvoiceDTO::fromRequest($request));

        return redirect()->route('invoices.index');
    }

    public function destroy(Invoice $invoice): SymfonyResponse
    {
        $this->invoiceService->delete($invoice);

        return redirect()->route('invoices.index');
    }

    public function payed(Invoice $invoice): SymfonyResponse
    {
        $this->invoiceService->payed($invoice, true);

        return redirect()->route('invoices.index');
    }
}
