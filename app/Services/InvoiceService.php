<?php

namespace App\Services;

use App\DTO\InvoiceDTO;
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
        return $this->pdfService->streamToPdf(
            view('pdf.invoice', [
                'invoice' => $invoice,
            ])
        );
    }

    public function all(): Collection
    {
        return $this->invoiceRepository->all();
    }

    public function store(InvoiceDTO $invoiceDTO): Invoice
    {
        $body = $this->generateBody($invoiceDTO);
        $invoiceDTO->setBody($body);

        return $this->invoiceRepository->store($invoiceDTO);
    }

    public function delete(Invoice $invoice): void
    {
        $this->invoiceRepository->delete($invoice);
    }

    public function generateBody(InvoiceDTO $invoiceDTO): array
    {
        $logs = $this->logService->findByCompanyTimeRange(
            $invoiceDTO->toCompany(),
            $invoiceDTO->getStartDate(),
            $invoiceDTO->getEndDate()
        );
        $total = $this->logService->sum($logs);

        return [
            'logs' => $logs,
            'total' => $total,
        ];
    }
}
