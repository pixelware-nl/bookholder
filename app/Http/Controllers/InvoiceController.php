<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Services\FreelanceLogService;
use App\Services\PDFService;
use Exception;
use Throwable;

class InvoiceController extends Controller
{
    /**
     * @throws Exception|Throwable
     */
    public function pdf(): \Illuminate\Http\Response
    {
        $freelanceLogService = new FreelanceLogService();
        $pdfService = new PDFService();

        $fromCompany = Company::where('name', 'Pixelware')->first();
        $toCompany = Company::where('name', 'InShared')->first();

        $logs = $freelanceLogService->getFreelanceLogs($toCompany);
        $total = $freelanceLogService->getFreelanceLogsTotal($logs);

        return $pdfService->streamToPdf(
            view('pdf.invoice', [
                'toCompany' => $toCompany,
                'fromCompany' => $fromCompany,
                'logs' => $logs,
                'total' => $total,
            ])
        );
    }


}
