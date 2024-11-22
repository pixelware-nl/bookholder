<?php

namespace App\Services;

use App\Models\Invoice;
use App\Repositories\LogRepository;
use Exception;
use Illuminate\Http\Response;
use Throwable;

readonly class InvoiceService
{
    public function __construct(
        private LogService $logService,
        private PDFService $pdfService
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
}
