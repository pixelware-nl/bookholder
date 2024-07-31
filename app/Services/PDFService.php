<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Throwable;

class PDFService
{
    /**
     * @throws Throwable
     */
    public function streamToPdf(View $view): Response
    {
        $pdf = Pdf::loadHTML($view->render());

        $pdf->setOption(['isRemoveEnabled' => true,]);
        $pdf->setPaper('a4');
        $pdf->render();

        return $pdf->stream('invoice.pdf');
    }

    /**
     * @throws Throwable
     */
    public function downloadToPdf(View $view): Response
    {
        $pdf = Pdf::loadHTML($view->render());

        $pdf->setOption(['isRemoveEnabled' => true,]);
        $pdf->setPaper('a4');
        $pdf->render();

        return $pdf->download('invoice.pdf');
    }
}
