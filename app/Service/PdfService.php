<?php namespace App\Service;
use App\Contracts\IPdf;
use App\Models\Reservation;
use PDF;
use Illuminate\Support\Facades\Storage;


class PdfService implements IPdf
{

    protected $pdffile;
    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;

        $pdf = PDF::setPaper('a4', 'portrait')->setOptions(['dpi' => 120, 'defaultFont' => 'sans-serif'])->loadView('pdf.reservation', (array)$this->reservation);
        return $pdf->save(storage_path()."/pdf/".$reservation['pnr'].'.pdf');
    }

    public function setPdf($pdf)
    {
        $this->pdffile = $pdf;
    }

    public function getPdf()
    {
       return $this->pdffile;
    }
}
