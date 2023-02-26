<?php namespace App\Service;
use App\Contracts\IPdf;
use App\Models\Plate;
use App\Models\Reservation;
use PDF;
use Illuminate\Support\Facades\Storage;


class PdfRevisionService implements IPdf
{

    protected $pdffile;
    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $data['reservation'] = $reservation;
        $data['image'] = $this->getImage($reservation->plate);
        \File::delete(storage_path()."/pdf/".$reservation->pnr.'.pdf');
        $pdf = PDF::setPaper('a4', 'portrait')->setOptions(['dpi' => 120, 'defaultFont' => 'sans-serif'])->loadView('pdf.reservationrevision', $data);
        return $pdf->save(storage_path()."/pdf/".$reservation->pnr.'.pdf');
    }

    public function setPdf($pdf)
    {
        $this->pdffile = $pdf;
    }

    public function getPdf()
    {
       return $this->pdffile;
    }

    public function getImage($id)
    {
        $plate =  Plate::find($id);
        if($plate)
        {
            $car = \App\Models\Car::find($plate->id_car);
            if($car)
            {
                return $car->default_images;
            }else{
                return NULL;
            }
        }else{
            return NULL;
        }

    }
}
