<?php

namespace App\Repositories\Interfaces;

use App\DTO\CompanyDTO;
use App\DTO\InvoiceDTO;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

interface InvoiceRepositoryInterface
{
    public function all(): Collection;

    public function findByCompany(Company $company): Collection;

    public function store(InvoiceDTO $invoiceDTO): Invoice;

    public function delete(Invoice $invoice): void;
}
