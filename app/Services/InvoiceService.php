<?php

namespace App\Services;

use App\Http\Requests\CreateInvoiceRequest;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\User;
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

        $logs = $freelanceLogService->getFreelanceLogs($invoice->toCompany, $invoice->start_date, $invoice->end_date);
        $total = $freelanceLogService->getFreelanceLogsTotal($logs);

        return $pdfService->streamToPdf(
            view('pdf.invoice', [
                'toCompany' => $invoice->toCompany,
                'fromCompany' => $invoice->fromCompany,
                'logs' => $logs,
                'total' => $total,
            ])
        );
    }
}
