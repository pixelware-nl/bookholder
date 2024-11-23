<?php

namespace App\Services;

use App\DTO\InvoiceDTO;
use App\Http\Requests\Invoices\CreateInvoiceRequest;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Throwable;

readonly class InvoiceService
{
    public function __construct(
        private LogService $logService,
        private PDFService $pdfService,
        private InvoiceRepository $invoiceRepository
    ) {}

    /**
     * @throws Exception|Throwable
     */
    public function generatePDF(Invoice $invoice): Response
    {
        $logs = $this->logService->getLogs($invoice->start_date, $invoice->end_date);
        $total = $this->logService->getTotalLogs($logs);

        return $this->pdfService->streamToPdf(
            view('pdf.invoice', [
                'toCompany' => $invoice->toCompany,
                'fromCompany' => $invoice->fromCompany,
                'start_date' => $invoice->start_date,
                'end_date' => $invoice->end_date,
                'logs' => $logs,
                'total' => $total,
            ])
        );
    }

    public function all(): Collection
    {
        return $this->invoiceRepository->all();
    }

    public function store(InvoiceDTO $invoiceDTO): Invoice
    {
        return $this->invoiceRepository->store($invoiceDTO);
    }

    public function delete(Invoice $invoice): void
    {
        $this->invoiceRepository->delete($invoice);
    }
}
