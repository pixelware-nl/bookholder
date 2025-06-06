<?php

namespace App\Repositories;

use App\DTO\InvoiceDTO;
use App\Models\Company;
use App\Models\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function all(): Collection
    {
        return Invoice::where('user_id', Auth::id())->get();
    }

    public function findByCompany(Company $company): Collection
    {
        return Invoice::where('user_id', Auth::id())->where('to_company_id', $company->id)->get();
    }

    public function store(InvoiceDTO $invoiceDTO): Invoice
    {
        return Invoice::create([
            'user_id' => $invoiceDTO->getUserId(),
            'from_company_id' => $invoiceDTO->getFromCompanyId(),
            'to_company_id' => $invoiceDTO->getToCompanyId(),
            'start_date' => $invoiceDTO->getStartDate(),
            'end_date' => $invoiceDTO->getEndDate(),
            'body' => $invoiceDTO->getBody(),
        ]);
    }

    public function update(Invoice $invoice, InvoiceDTO $invoiceDTO): Invoice
    {
        $invoice->update([
            'from_company_id' => $invoiceDTO->getFromCompanyId(),
            'to_company_id' => $invoiceDTO->getToCompanyId(),
            'start_date' => $invoiceDTO->getStartDate(),
            'end_date' => $invoiceDTO->getEndDate(),
            'body' => $invoiceDTO->getBody(),
        ]);

        return $invoice;
    }

    public function payed(Invoice $invoice, bool $payed): Invoice
    {
        $invoice->update([
            'payed' => $payed,
        ]);

        return $invoice;
    }

    public function delete(Invoice $invoice): void
    {
        $invoice->delete();
    }
}
