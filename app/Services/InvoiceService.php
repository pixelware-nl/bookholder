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
        if ($invoice->payed == false) {
            $invoiceDTO = InvoiceDTO::fromModel($invoice);
            $invoice = $this->update($invoice, $invoiceDTO);
        }

        $filename = sprintf(
            "%s-%s-%s_%s.pdf",
            __('invoice.pdf.name'),
            strtolower($invoice->fromCompany->name),
            DateService::format($invoice->start_date),
            DateService::format($invoice->end_date)
        );

        return $this->pdfService->streamToPdf(
            view('pdf.invoice', [
                'invoice' => $invoice,
            ]),
            $filename
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

    public function update(Invoice $invoice, InvoiceDTO $invoiceDTO): Invoice
    {
        $body = $this->generateBody($invoiceDTO);
        $invoiceDTO->setBody($body);

        return $this->invoiceRepository->update($invoice, $invoiceDTO);
    }

    public function delete(Invoice $invoice): void
    {
        $this->payed($invoice, false);

        $this->invoiceRepository->delete($invoice);
    }

    public function payed(Invoice $invoice, bool $payed): Invoice
    {
        $invoice = $this->invoiceRepository->payed($invoice, $payed);

        $logs = $this->logService->findByCompanyTimeRange(
            $invoice->toCompany,
            $invoice->start_date,
            $invoice->end_date
        );

        foreach ($logs as $log) {
            $this->logService->payed($log, $payed);
        }

        return $invoice;
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
            'total' => $total * 1.21,
            'btw' => $total * 0.21,
        ];
    }
}
