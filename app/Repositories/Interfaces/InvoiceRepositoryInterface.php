<?php

namespace App\Repositories\Interfaces;

use App\DTO\InvoiceDTO;
use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;

interface InvoiceRepositoryInterface
{
    public function all(): Collection;

    public function findByCompany(Company $company): Collection;

    public function store(InvoiceDTO $invoiceDTO): Invoice;

    public function delete(Invoice $invoice): void;
}
