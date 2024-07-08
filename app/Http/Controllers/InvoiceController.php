<?php

namespace App\Http\Controllers;


use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * @throws \Exception
     */
    public function pdf(): \Illuminate\Http\Response
    {
        $pdf = Pdf::loadHTML(
            view('pdf.invoice', [
            ])->render()
        );

        $pdf->setOption([
            'isRemoveEnabled' => true,
        ]);

        $pdf->setPaper('a4');
        $pdf->render();

        return $pdf->stream('archive.pdf');
    }
}
