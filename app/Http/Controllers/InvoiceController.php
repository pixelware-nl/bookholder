<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\FreelanceLogService;
use App\Services\PDFService;
use Exception;
use Illuminate\Http\Response;
use Throwable;

// TODO:
// The following is a wishlist from yours truly.
// * Create authentication for the user to login
// * An user is tied to a company
// * The fromCompany will always be the logged in users company
// * The toCompany can be selected in a select box
// * * Eventual extra would be to make a user relations table to see which user works for who
// * User can create his own "products", also in a seperate view
// * User can log his own hours in a calendar type view

class InvoiceController extends Controller
{
    /**
     * @throws Exception|Throwable
     */
    public function pdf(): Response
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
