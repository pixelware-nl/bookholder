<?php

namespace App\Services;

use App\Models\Invoice;
use Exception;
use Illuminate\Http\Response;
use Throwable;

class InvoiceService
{
    /**
     * @throws Exception|Throwable
     */
    public function generatePDF(Invoice $invoice): Response
    {
        $freelanceLogService = new FreelanceLogService();
        $pdfService = new PDFService();

        $logs = $freelanceLogService->getFreelanceLogsForCompany($invoice->toCompany, $invoice->start_date, $invoice->end_date);
        $total = $freelanceLogService->getFreelanceLogsTotal($logs);

        return $pdfService->streamToPdf(
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
