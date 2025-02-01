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
    public function streamToPdf(View $view, ?string $name = null): Response
    {
        $pdf = Pdf::loadHTML($view->render());

        $pdf->setOption(['isRemoveEnabled' => true,]);
        $pdf->setPaper('a4');
        $pdf->render();

        return $pdf->stream($name ?? 'invoice.pdf');
    }

    /**
     * @throws Throwable
     */
    public function downloadToPdf(View $view, ?string $name = null): Response
    {
        $pdf = Pdf::loadHTML($view->render());

        $pdf->setOption(['isRemoveEnabled' => true,]);
        $pdf->setPaper('a4');
        $pdf->render();

        return $pdf->download($name ?? 'invoice.pdf');
    }
}
