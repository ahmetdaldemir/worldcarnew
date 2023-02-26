<?php namespace App\Service;
use PDF;


class PdfService
{
    public function handle()
    {

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }
}
