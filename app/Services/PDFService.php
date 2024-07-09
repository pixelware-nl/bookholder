<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class PDFService
{
    /**
     * @throws \Throwable
     */
    public function streamToPdf(View $view): \Illuminate\Http\Response
    {
        $pdf = Pdf::loadHTML($view->render());

        $pdf->setOption(['isRemoveEnabled' => true,]);
        $pdf->setPaper('a4');
        $pdf->render();

        return $pdf->stream('invoice.pdf');
    }
}
